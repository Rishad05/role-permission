@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Add new user</h1>
    <div class="lead">
        Add new user and assign role.
    </div>

    <div class="container mt-4">
        <form method="POST" action="">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name"
                    required>

                @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            {{-- @dd($roles) --}}
            {{-- <div class="mb-3">
                <label for="name" class="form-label">Role</label>
                <select name="role_id"
                    class="form-control @error('role_id') is-invalid @enderror js-example-templating " required>
                    <option></option>
                    @foreach ($roles as $role)
                    <option @if( old('role_id')==$role->id ) selected @endif value="{{ $role->id }}">
                        {{ $role->name }}
                    </option>
                    @endforeach
                </select>

                @error('role_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div> --}}
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" name="role" required>
                    <option value="">Select role</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('role'))
                <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="{{ old('email') }}" type="email" class="form-control" name="email"
                    placeholder="Email address" required>
                @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input value="{{ old('username') }}" type="text" class="form-control" name="username"
                    placeholder="Username" required>
                @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Save user</button>
            <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
        </form>
    </div>

</div>
@endsection