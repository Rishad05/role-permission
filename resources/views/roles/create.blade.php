@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Add new role</h1>
    <div class="lead">
        Add new role and assign permissions.
    </div>

    <div class="container mt-4">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name"
                    required>
            </div>

            <label for="permissions" class="form-label">Assign Permissions</label>
            <div class="border border-dark p-3 m-5">
                <h6>User Module</h6>
                <table class="table table-striped ">
                    <thead>
                        <th scope="col" width="50%">Name</th>
                        <th scope="col" width="50%"> All <input type="checkbox" name="all_permission">
                        </th>

                        {{-- <th scope="col" width="1%">Guard</th> --}}
                    </thead>

                    @foreach($userpermissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <input type="checkbox" name="permission[{{ $permission->name }}]"
                                value="{{ $permission->name }}" class='permission'>
                        </td>

                        {{-- <td>{{ $permission->guard_name }}</td> --}}
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="border border-dark p-3 m-5">
                <h6>Post Module</h6>
                <table class=" table table-striped ">
                    <thead>
                        <th scope="col" width="50%">Name</th>
                        <th scope=" col" width="50%"> All <input type="checkbox" name="all_permission">
                        </th>


                        {{-- <th scope="col" width="1%">Guard</th> --}}
                    </thead>

                    @foreach($postpermissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <input type="checkbox" name="permission[{{ $permission->name }}]"
                                value="{{ $permission->name }}" class='permission'>
                        </td>

                        {{-- <td>{{ $permission->guard_name }}</td> --}}
                    </tr>
                    @endforeach
                </table>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save user</button>
            <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
        </form>
    </div>

</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }

            });
        });
</script>
@endsection