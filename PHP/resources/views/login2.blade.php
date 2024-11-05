@extends('layout')
@section('title', "login")
@section('content')
    <div class="container ms-auto me-auto">
        <div class="mt-2 mb-2">
            @if ($errors -> any())
                <div class="col-12">
                    @foreach ($errors->all() as $error )
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                </div>
            @endif
            
            <h1>hola</h1>
            @if (session()->has("error"))
             <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            @if (session()->has("success"))
             <div class="alert alert-sucess">{{session('sucess')}}</div>
            @endif
        </div>

        <form class="ms-auto me-auto mt-3 " action="{{route('login.post')}}" method="POST" style="width: 400px">
            @csrf
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