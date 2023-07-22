@extends('layouts.app')

@section('content')
    <h1>Users</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Create New User</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($users->isEmpty())
                <tr>
                    <td colspan="100%">
                        <div class="alert alert-info text-center">No users found.</div>
                    </td>
                </tr>
            @endif

            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-secondary">Update User</a>
                        <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteUserForm{{$user->id}}').submit();">Delete User</button>
                    </td>
                    @include('users.delete')
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links('pagination::bootstrap-4') }}

@endsection
