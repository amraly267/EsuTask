
@extends('layouts.app')

@section('content')
    <h1>Create New User</h1>

    @include('users.form', ['action' => route('users.store'), 'user' => new App\Models\User(), 'method' => 'post'])
@endsection
