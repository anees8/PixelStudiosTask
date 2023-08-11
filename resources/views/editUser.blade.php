        @extends('layouts.master')
        @section('title',  isset($user) ? 'Edit User' : 'Create User' )
        @section('content')
        <div class="container">
        <h2>{{ isset($user) ? 'Edit' : 'Create' }} User</h2>
        <div class="d-flex align-items-center justify-content-start mb-2">
       
          
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Home</a>
    
            </div>
        <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST" enctype="multipart/form-data">
        @if ($errors->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        @csrf
        @if(isset($user))
        @method('PATCH')
        @endif
        <div class="form-group">
        <label for="name">Name:</label>
        <input type="text"  class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ isset($user) ? $user->name : old('name') }}">

        @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
        </div>
        <div class="form-group">
        <label for="role">Role:</label>
        <select  class="form-control {{ $errors->has('role') ? ' is-invalid' : '' }}" id="role" name="role" >
        <option value="1" {{ (isset($user) && $user->role_id == 1) ? 'selected' : '' }}>Sales</option>
        <option value="2" {{ (isset($user) && $user->role_id == 2) ? 'selected' : '' }}>Manager</option>
        <option value="3" {{ (isset($user) && $user->role_id == 3) ? 'selected' : '' }}>Customer</option>
        </select>
        @if ($errors->has('role'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('role') }}</strong>
        </span>
        @endif
        </div>



        <div class="form-group">
        <label for="email">Email:</label>
        <input type="email"  class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ isset($user) ? $user->email : old('email') }}" >
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
        </div>
        <!-- Profile Image -->
        <div class="form-group">
        <label for="profile_image">Profile Image:</label>
        <input type="file"  class="form-control {{ $errors->has('profile_image') ? ' is-invalid' : '' }}" id="profile_image" name="profile_image">
        @if ($errors->has('profile_image'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('profile_image') }}</strong>
        </span>
        @endif   
        </div>

        <!-- Address -->
        <div class="form-group">
        <label for="address">Address:</label>
        <textarea  class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" name="address">{{ isset($user) ? $user->address : old('address') }}</textarea>
        @if ($errors->has('address'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('address') }}</strong>
        </span>
        @endif   
        </div>
        <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="number"  class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" id="phone" name="phone" value="{{ isset($user) ? $user->phone : old('phone') }}" minlength="10" maxlength="10" >
        @if ($errors->has('phone'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('phone') }}</strong>
        </span>
        @endif
        </div>

        <div class="form-group">
        <label for="gender">Gender:</label>
        <select  class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}" id="gender" name="gender">
        <option value="male" {{ (isset($user) && $user->gender == 'male') ? 'selected' : '' }}>Male</option>
        <option value="female" {{ (isset($user) && $user->gender == 'female') ? 'selected' : '' }}>Female</option>
        <option value="other" {{ (isset($user) && $user->gender == 'other') ? 'selected' : '' }}>Other</option>
        </select>
        @if ($errors->has('gender'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('gender') }}</strong>
        </span>
        @endif
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Update' : 'Create' }}</button>
        </form>
        </div>
        @endsection
