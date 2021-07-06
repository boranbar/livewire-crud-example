@extends('welcome')
@section('content')
<div class="card mt-5">
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{session()->get('success')}}
        </div>
    @endif
    <div class="card-body">
        <form action="{{route('users.update',$user)}}" method="POST">
            @method('PATCH')
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Name</label>
                <input type="text" name="name" value="{{$user->name}}" class="form-control" id="exampleInputName1">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" readonly value="{{$user->email}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('users.index')}}" class="btn btn-secondary">Go Back</a>
            @csrf
        </form>
    </div>
</div>
@endsection
