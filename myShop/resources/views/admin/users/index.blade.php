@extends('admin.layout.app')
@section('mainPart')

<!-- START: Page Header Banner -->
<div class="page-header">
    <div>
        <h1 class="page-title">User Table</h1>
    </div>
</div>
<!-- END: Page Header Banner -->

<!-- Table Card Container -->
<div class="table-card-custom">
    <!-- Header Controls -->
    <div class="table-header-control">
        <!-- Search bar -->
        <div class="table-search-box">
            <i class="bi bi-search table-search-icon"></i>
            <input type="text" class="table-search-input" placeholder="Search orders or products...">
        </div>
        <!-- Action buttons / Filter options -->
        <div class="table-filter-group">
            <div class="dropdown">
                <button class="btn-table-action dropdown-toggle" type="button" id="dropdownFilterStatus"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-funnel"></i> Status Filter
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownFilterStatus">
                    <li><a class="dropdown-item" href="#">All Statuses</a></li>
                    <li><a class="dropdown-item" href="#">Paid / Success</a></li>
                    <li><a class="dropdown-item" href="#">Processing</a></li>
                    <li><a class="dropdown-item" href="#">Cancelled / Failed</a></li>
                </ul>
            </div>
            <button class="btn-table-action" type="button">
                <i class="bi bi-file-earmark-arrow-down"></i> Export
            </button>
        </div>
    </div>

    <!-- Responsive Table Wrapper -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Joining Date</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 -->
                @foreach ($users as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{$user->roles->first()?->name}}</td>
                    <td>{{$user->created_at->format('d-m-y')}}</td>
                    <td>
                        @if ($user->is_active==1)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Deactive</span>
                        @endif

                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="#" class="table-btn-action" title="View details"><i class="bi bi-eye"></i></a>
                            <a href="{{route('user.edit',['id'=>$user->id])}}" class="table-btn-action"
                                title="Edit row"><i class="bi bi-pencil"></i></a>
                            <a href="#" class="table-btn-action delete" title="Delete row"><i
                                    class="bi bi-trash"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>



</div>
<!-- END: Basic Table Card Container -->
@endsection