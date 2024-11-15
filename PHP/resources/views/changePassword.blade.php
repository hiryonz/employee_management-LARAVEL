@extends('layout')
@section('title', 'Cambiar Contraseña')
@section('content')


<div class="change-password-container">
    <x-error-management/>

    <form class="change-password-form" action="{{route('change.password')}}" method="post">
        @csrf
        <div class="change-password-title-container">
            <h4><strong>Cambiar Contraseña</strong></h4>   
        </div>    
        <hr>
        <div class="row mb-5 d-flex justify-content-center">
            <div class="col-md-6">
                <label for="passwordOld">Contraseña vieja</label>
                <input type="password" class="form-control" name="passwordOld" id="passwordOld" placeholder="Contraseña vieja" required>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <label for="password">Contraseña nueva</label>
                <div class="row">
                    <div class="col d-flex change-password mb-2">
                        <input type="password" class="form-control" name="passwordNew" id="passwordNew" placeholder="Contraseña nueva" required>
                        <div>
                            <button type="button" class="btn view-password" onclick="activarPasword(event)">ver</button>
                        </div>
                    </div>
                    <div class="col d-flex change-password">
                        <input type="password" class="form-control" name="passwordNew_confirmation" id="passwordNew_confirmation" placeholder="Repetir la contraseña nueva" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="change-password-btn-container ">
            <button class="btn btn-light" type="submit">Cambiar</button>
        </div>
    </form>
</div>

@include('include.javascript.formFunction')

@endsection

<!--label for="password">Contraseña nueva</label>
            <input type="password" class="form-control mb-2" name="password" value="{{ old('password') }}" id="password" placeholder="Contraseña nueva" required>
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" id="password" placeholder="Repetir contraseña nueva" required>

                <div>
                    <button type="button" class="btn view-password" onclick="activarPasword(event)">ver</button>
                </div-->