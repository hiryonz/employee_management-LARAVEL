@extends("layout")
@section('title', 'employee view')
@section('content')


    <div class="parent-container-viewEmployee">
        <h1>Datos de empleado</h1>
        <div class="container-employee-data" >
            <div class="tables">
                <x-tables-layout name="employee" :employee="$employee" :></x-tables-layout>
            </div>
        </div>
    </div>

@endsection