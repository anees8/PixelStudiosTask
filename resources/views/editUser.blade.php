@extends('layouts.master')
@section('title',  isset($user) ? 'Edit User' : 'Create User' )
@section('content')
<div class="container">
    <h2>{{ isset($user) ? 'Edit' : 'Create' }} User</h2>
    <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($user))
            @method('PATCH')
        @endif
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ isset($user) ? $user->name : old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control" id="role" name="role" required>
                <option value="1" {{ (isset($user) && $user->role_id == 1) ? 'selected' : '' }}>Sales</option>
                <option value="2" {{ (isset($user) && $user->role_id == 2) ? 'selected' : '' }}>Manager</option>
                <option value="3" {{ (isset($user) && $user->role_id == 3) ? 'selected' : '' }}>Customer</option>
            </select>
        </div>
        <!-- Add other fields: email, phone, gender, address, profile image -->
        <!-- Example: Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ isset($user) ? $user->email : old('email') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
