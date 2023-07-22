@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>

    @include('users.form', ['action' => route('users.update', $user->id), 'user' => $user, 'method' => 'put'])
@endsection
