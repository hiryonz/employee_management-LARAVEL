@extends('layout')
@section('title', "login")
@section('content')
    <div class="container">
        <div class="mt-5 mb-5">
            @if ($errors -> any())
                <div class="col-12">
                    @foreach ($errors->all() as $error )
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                </div>
            @endif

            @if (session()->has("error"))
             <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            @if (session()->has("success"))
             <div class="alert alert-sucess">{{session('sucess')}}</div>
            @endif
        </div>
            <?php $route = "registration.post" ?>
            <div class="formulario-container-employee">
                <x-employee-form-layout :route="$route"></x-employee-form-layout>
            </div>

        </form>
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