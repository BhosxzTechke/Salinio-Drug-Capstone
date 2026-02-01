@extends('admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<style>
/* =====================
   MODERN SPLIT VIEW UX
===================== */

.permission-layout {
    display: flex;
    gap: 1.5rem;
    min-height: 500px;
}

/* Left Sidebar */
.permission-sidebar {
    width: 260px;
    border-right: 1px solid #e5e7eb;
}

.permission-group-item {
    padding: 10px 14px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.15s;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.permission-group-item:hover,
.permission-group-item.active {
    background-color: #f1f5f9;
}

.permission-group-item input {
    margin-right: 10px;
}

/* Right Content */
.permission-content {
    flex: 1;
}

.permission-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 12px;
}

.permission-box {
    padding: 10px 12px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    transition: 0.15s;
}

.permission-box:hover {
    background: #f8fafc;
}
</style>

<div class="content">
    <div class="container-fluid">

        <h4 class="page-title mb-3">Add Role Permission</h4>

        <form id="permissionForm" method="POST" action="{{ route('role.permission.store') }}">
            @csrf

            <!-- Top Controls -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Role Name</label>


                    <select name="role_id" class="form-select" required>
                        <option selected disabled>Select Role</option>
                        @foreach($roles as $item)
                            @if($item->name !== 'Super Admin')
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="custome_selectAll">
                        <label class="form-check-label fw-semibold">
                            Select All Permissions
                        </label>
                    </div>
                </div>
            </div>

            <!-- Split Layout -->
            <div class="permission-layout">

                <!-- LEFT: GROUP LIST -->
                <div class="permission-sidebar">
                        @foreach ($permissionGroups as $index => $group)
                            @php $groupSlug = \Illuminate\Support\Str::slug($group->group_name); @endphp
                            <div class="permission-group-item {{ $index === 0 ? 'active' : '' }}"
                                data-group="{{ $groupSlug }}">
                                <div class="form-check m-0">
                                    <input class="form-check-input group-checkbox"
                                        type="checkbox"
                                        id="group_{{ $groupSlug }}">
                                    <label class="form-check-label fw-medium">
                                        {{ ucwords(str_replace('', ' ',  $group->group_name)) }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>




                <!-- RIGHT: PERMISSIONS -->
                <div class="permission-content">
                    @foreach ($permissionGroups as $index => $group)
                        @php
                            $groupSlug = \Illuminate\Support\Str::slug($group->group_name);
                            $permissions = \App\Models\User::getPermissionByGroup($group->group_name);
                        @endphp

                        <div class="permission-panel {{ $index !== 0 ? 'd-none' : '' }}"
                             data-panel="{{ $groupSlug }}">

                            <h6 class="mb-3 fw-semibold">{{ ucwords(str_replace('-', ' ', $group->group_name)) }} Permissions</h6>

                            <div class="permission-grid">
                                @foreach ($permissions as $permission)
                                    <div class="permission-box">
                                        <div class="form-check m-0">
                                            <input class="form-check-input permission-checkbox"
                                                    type="checkbox"
                                                    name="permission[]"
                                                    value="{{ $permission->id }}"
                                                    data-group="{{ $groupSlug }}">
                                            <label class="form-check-label">
                                                {{ ucwords(str_replace('-', ' ', $permission->name)) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>

            <!-- Save -->
            <div class="text-end mt-4">
                <button class="btn btn-success px-4">
                    <i class="mdi mdi-content-save"></i> Save Permissions
                </button>
            </div>

        </form>

    </div>
</div>

{{-- =====================
   JS LOGIC
===================== --}}
<script>
$(document).ready(function () {

    // Sidebar navigation
    $('.permission-group-item').on('click', function (e) {
        if (!$(e.target).is('input')) {
            $('.permission-group-item').removeClass('active');
            $(this).addClass('active');

            let group = $(this).data('group');
            $('.permission-panel').addClass('d-none');
            $('[data-panel="' + group + '"]').removeClass('d-none');
        }
    });

    // Select all
    $('#custome_selectAll').on('change', function () {
        $('.group-checkbox, .permission-checkbox').prop('checked', this.checked);
    });

    // Group checkbox
    $('.group-checkbox').on('change', function () {
        let group = $(this).attr('id').replace('group_', '');
        $('.permission-checkbox[data-group="' + group + '"]')
            .prop('checked', this.checked);
    });

});
</script>

@endsection
