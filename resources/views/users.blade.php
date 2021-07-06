@extends('welcome')
@section('content')
    <div class="table-responsive mt-5">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">E-Mail</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                {{--   if we need to hash the id in manually  --}}
                <tr id="{{Hashids::connection(\App\Models\User::class)->encode($user->id)}}">
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><a href="{{route('users.edit',$user)}}" class="btn btn-primary btn-sm">Edit</a></td>
                    <td>
                        <form action="{{route('users.destroy',$user)}}" method="POST">
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                Delete
                            </button>
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        {{ $users->links() }}
    </div>
@endsection
