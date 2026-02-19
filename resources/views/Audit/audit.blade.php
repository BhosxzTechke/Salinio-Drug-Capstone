@extends('admin_dashboard')
@section('admin')


<br>


<form method="GET" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="user" class="form-control" placeholder="Search by User">
    </div>
    <div class="col-md-4">
        <input type="text" name="action" class="form-control" placeholder="Search by Action">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
</form>


<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>🕵️ Audit Trail</h4>
        </div>
        <div class="card-body">
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Model</th>
                        <th>Old Value</th>
                        <th>New value</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                 @php $i = 1 @endphp

                    @foreach($activities as $key => $log)
            <tr>

                
                <td>{{ $i++ }}</td>
                <td>{{ optional($log->causer)->name ?? 'System' }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ class_basename($log->subject_type) }}</td>


                        <td>
                            @php
                                $old = $log->properties['old'] ?? null;
                            @endphp

                            @if(is_array($old))
                                <ul class="mb-0">
                                    @foreach($old as $key => $value)
                                        <li>
                                            <strong>{{ ucfirst(str_replace('_',' ',$key)) }}:</strong>
                                            {{ is_array($value) ? implode(', ', $value) : $value }}
                                        </li>
                                    @endforeach
                                </ul>
                            @elseif(!empty($old))
                                {{ $old }}
                            @else
                                —
                            @endif
                        </td>




                    <td>
                        @php
                            $new = $log->properties['new'] ?? null;
                        @endphp

                        @if(is_array($new))
                            <ul class="mb-0">
                                @foreach($new as $key => $value)
                                    <li>
                                        <strong>{{ ucfirst(str_replace('_',' ',$key)) }}:</strong>
                                        {{ is_array($value) ? implode(', ', $value) : $value }}
                                    </li>
                                @endforeach
                            </ul>
                        @elseif(!empty($new))
                            {{ $new }}
                        @else
                            —
                        @endif
                    </td>


                <td>{{ $log->created_at }}</td>
            </tr>
                    @endforeach
                </tbody>
            </table>

 
        </div>
    </div>




</div>



@endsection