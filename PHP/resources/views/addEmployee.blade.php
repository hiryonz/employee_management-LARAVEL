@extends('layout')
@section('title', "Registrar Empleado")
@section('content')
    <div class="container">

        <x-error-management/>

        <?php $route = "registration.post" ?>
        <div class="formulario-container-employee">
            <x-employee-form-layout :route="$route"></x-employee-form-layout>
        </div>

    </div>


    @include('include.javascript.validation')
    @include('include.javascript.calcularPlanilla')
    @include('include.javascript.formFunction')

@endsection