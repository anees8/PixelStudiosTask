@extends('layouts.master')
@section('title', 'Users')
    @section('content')
    <div class="container" style="margin-top: 50px;">
        <h4 style="text-align: center;">Users List</h4>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create User</a>
        <table class="table table-bordered" id="data-table">
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
                name: 'gender'
            }, {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'role.name',
                name: 'role'
            },
            {
                data: 'profile_image',
                name: 'profile',
                render: function(data, type, full, meta) {
                if (data) {
                    return '<img src="' + data + '" alt="Profile Image" width="50">';
                } else {
                    return '';
                }
            },
            defaultContent: ''
            },
            {
                data: 'address',
                name: 'address',
                defaultContent: '' 
            },
            {
                data: 'status',
                name: 'Status'
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