@extends('layouts.master')
@section('title', 'Users')
    @section('content')
    <div class="container fluid vh-100" style="margin-top: 5px;">
        <h4 style="text-align: center;">Users List</h4>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create User</a>
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