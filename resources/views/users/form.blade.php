@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ $action }}" method="POST">
    @method($method) @csrf
    <!-- Common form fields -->
    <div class="form-group mb-3">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value="{{ old('name', $user->name ?? '') }}">
    </div>
    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="{{ old('email', $user->email ?? '') }}">
    </div>
    <div class="form-group mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
    </div>
    <div class="form-group mb-3">
        <label for="confirm password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter confirm password" >
    </div>
    <!-- Additional form fields for other user properties -->
    <button type="submit" class="btn btn-success">Save</button>
</form>
