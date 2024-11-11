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

    <script>
        document.addEventListener('DOMContentLoaded', ()=> {
            initializePlanillaCalculators(document.querySelector('.formulario-container-employee'))
        })

        function limpiarFormulario(event) {
            const form = event.target.closest('form')
            form.reset();
            window.scrollTo({top:0, behavior: 'smooth'})
        } 


        function activarPasword(event) {
            const form = event.target.closest('form')
            const password = form.querySelector('#password')

            console.log(password)
            if(password.type == 'password') {
                password.type = 'text'
            }else {
                password.type = 'password'
            }
        }
    </script>
@endsection