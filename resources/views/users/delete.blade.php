<form id="deleteUserForm{{$user->id}}" action="{{route('users.destroy', $user->id)}}" method="post">
    @method('delete') @csrf
</form>
