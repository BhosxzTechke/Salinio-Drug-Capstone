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
    min-height: 520px;
}

/* LEFT SIDEBAR */
.permission-sidebar {
    width: 280px;
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

/* RIGHT CONTENT */
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

        <h4 class="page-title mb-3">Edit Role Permission</h4>

        <form id="myForm"
              method="POST"
              action="{{ route('role.permission.update', $roles->id) }}">
            @csrf

            <!-- Top Bar -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <span class="badge bg-primary fs-5 py-2 px-3">
                        {{ $roles->name }}
                    </span>
                </div>

                <div class="col-md-4 d-flex align-items-center">
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
                        @php
                            $groupSlug = Str::slug($group->group_name);
                            $permissions = App\Models\User::getPermissionByGroup($group->group_name);
                        @endphp

                        <div class="permission-group-item {{ $index === 0 ? 'active' : '' }}"
                             data-group="{{ $groupSlug }}">
                            <div class="form-check m-0">
                                <input class="form-check-input group-checkbox"
                                       type="checkbox"
                                       id="group_{{ $groupSlug }}"
                                       data-group="{{ $groupSlug }}"
                                       {{ App\Models\User::roleHasPermissions($roles, $permissions) ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium">
                                        {{ ucwords(str_replace('', ' ',   $group->group_name)) }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- RIGHT: PERMISSIONS -->
                <div class="permission-content">
                    @foreach ($permissionGroups as $index => $group)
                        @php
                            $groupSlug = Str::slug($group->group_name);
                            $permissions = App\Models\User::getPermissionByGroup($group->group_name);
                        @endphp

                        <div class="permission-panel {{ $index !== 0 ? 'd-none' : '' }}"
                                data-panel="{{ $groupSlug }}">

                            <h6 class="fw-semibold mb-3">
                                {{ ucwords(str_replace('', ' ',   $group->group_name)) }} Permissions
                            </h6>

                            <div class="permission-grid">
                                @foreach ($permissions as $permission)
                                    <div class="permission-box">
                                        <div class="form-check m-0">
                                            <input class="form-check-input permission-checkbox"
                                                    type="checkbox"
                                                    name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    data-group="{{ $groupSlug }}"
                                                    {{ $roles->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                {{ ucwords(str_replace('-', ' ',  $permission->name)) }}
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
                    <i class="mdi mdi-content-save"></i> Update Permissions
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

    // Select All
    $('#custome_selectAll').on('change', function () {
        $('.group-checkbox, .permission-checkbox')
            .prop('checked', this.checked)
            .prop('indeterminate', false);
    });

    // Group checkbox
    $('.group-checkbox').on('change', function () {
        let group = $(this).data('group');
        $('.permission-checkbox[data-group="' + group + '"]')
            .prop('checked', this.checked);

        updateStates();
    });

    // Permission checkbox
    $('.permission-checkbox').on('change', function () {
        updateStates();
    });

    function updateStates() {
        // Groups
        $('.group-checkbox').each(function () {
            let group = $(this).data('group');
            let perms = $('.permission-checkbox[data-group="' + group + '"]');
            let checked = perms.filter(':checked').length;

            if (checked === 0) {
                $(this).prop('checked', false).prop('indeterminate', false);
            } else if (checked === perms.length) {
                $(this).prop('checked', true).prop('indeterminate', false);
            } else {
                $(this).prop('checked', false).prop('indeterminate', true);
            }
        });

        // Select All
        let total = $('.permission-checkbox').length;
        let checkedTotal = $('.permission-checkbox:checked').length;

        if (checkedTotal === 0) {
            $('#custome_selectAll').prop('checked', false).prop('indeterminate', false);
        } else if (checkedTotal === total) {
            $('#custome_selectAll').prop('checked', true).prop('indeterminate', false);
        } else {
            $('#custome_selectAll').prop('checked', false).prop('indeterminate', true);
        }
    }

    // Init on load
    updateStates();
});
</script>

@endsection
