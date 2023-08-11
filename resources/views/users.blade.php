@extends('layouts.master')
@section('title', 'Users')
    @section('content')
    <div class="container fluid max-vh-100" style="margin-top: 5px;">
        <h4 style="text-align: center;">Users List</h4>
        <div class="d-flex align-items-center justify-content-end mb-2">
       
        <a href="{{ route('export.users') }}" class="btn btn-success mr-2">Export All Users</a>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>

        </div>
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @endif
        <table class="table table-bordered table-sm table-responsive" id="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Profile</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection

@section('script')
<script type="text/javascript">
$(function() {

    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'gender',
                name: 'gender',
                
            }, {
                data: 'phone',
                name: 'phone',
               
            },
            {
                data: 'role.name',
                name: 'role',
                searchable: false,
                
            },
            {
                data: 'profile_image',
                name: 'profile',
                searchable: false,
                render: function(data, type, full, meta) {
                if (data) {
                    var baseUrl = '{{ asset('profile_images') }}';
                    return '<img src="' + baseUrl + '/'  + data + '" alt="Profile Image" width="50">';
                } else {
                    return '';
                }
            },
            defaultContent: ''
            },
            {
                data: 'address',
                name: 'address',
                defaultContent: '' ,
                searchable: false
            },
            {
                data: 'status',
                name: 'Status',
                searchable: false
            },
           
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });

});
</script>
@endsection