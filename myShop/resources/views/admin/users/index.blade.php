@extends('admin.layout.app')
@section('mainPart')

<!-- START: Page Header Banner -->
<div class="page-header">
    <div>
        <h1 class="page-title">User Table</h1>
    </div>
</div>
<!-- END: Page Header Banner -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('failed'))
<div class="alert alert-danger">{{ session('failed') }}</div>
@endif


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
                            <a href="#" class="table-btn-action delete-link" title="Delete row"
                                data-url="{{ route('user.destroy', ['id' => $user->id]) }}">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

        <!-- Div Modal for User Delete-->
        <div id="deleteModal" class="modal-overlay">
            <div class="modal-box">
                <h3>Are you sure?</h3>
                <p>This record will be deleted permanently.</p>

                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="button" id="cancelDelete" class="btn-cancel">Cancel</button>
                    <button type="submit" class="btn-yes">Yes, delete</button>
                </form>
            </div>
        </div>
    </div>



</div>
<!-- END: Basic Table Card Container -->

<script>
    const modal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');
    const cancelBtn = document.getElementById('cancelDelete');

    // Open modal when any delete link is clicked
    document.querySelectorAll('.delete-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();                 // stop the link from navigating
            deleteForm.action = this.dataset.url;      // put the route (with id) into the form
            modal.classList.add('active');      // show modal
        });
    });

    // Close on Cancel
    cancelBtn.addEventListener('click', () => modal.classList.remove('active'));

    // Close when clicking the dark overlay (outside the box)
    modal.addEventListener('click', e => {
        if (e.target === modal) modal.classList.remove('active');
    });
</script>
@endsection