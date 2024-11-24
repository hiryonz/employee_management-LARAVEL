@extends('layout')
@section('title', "login")
@section('content')


        <form class="ms-auto me-auto mt-3 " action="{{route('login.post')}}" method="POST" style="width: 400px">
            @csrf
            <h1>Login</h1>
            <div class="form-group" >
                <label for="user">User</label>
                <input type="text" class="form-control" id="user" name="user" placeholder="Enter user name">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection