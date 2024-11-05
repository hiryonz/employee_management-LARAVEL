@extends('layout')
@section('title', 'Detailed Employee Data')
@section('style')
<style>

</style>
@endsection
@section('content')
@include('include.javascript.validation')
@include('include.javascript.calcularPlanilla')


    <div class="parent-container-viewEmployeeData">
        <div class="main-data">
            <div class="finder-container-EmployeeData">
                <x-search-bar  :employeeData="$smallEmployeeData"></x-search-bar>
            </div>
            <x-employee-data-detailed 
            :employeeData="$employeeData"
            :direcionData="$direcionData"
            :planillaData="$planillaData"
            :userData="$userData"></x-employee-data-detailed>
        </div>

        <div class="graph-data">
            <div class="time-container-data">
                <div class="container-employee-time-graph">
                    <h2>2</h2>
                </div>
            </div>

            <div class="task-container-data">
                <div class="container-employee-task-graph">
                    <h2>4</h2>
                </div>
            </div>

        </div>

        <div class="task-data">
        <p>1</p>

        </div>
    </div>

    @include('include.javascript.tables')
    <script>


        const inputs = document.querySelectorAll('.form-control');


        function asignSelect() {
            const departamento = document.getElementById('departamento');
            const cargo = document.getElementById('tipo');
            const descripcion = document.getElementById('descripcion')
            const id_turno = document.getElementById('turno');
            id_turno.value = `<?php echo isset($employeeData[0]['id_turno']) ? $employeeData[0]['id_turno'] : '' ?>`;
            console.log(id_turno.value)
            departamento.value = `<?php echo isset($employeeData[0]['departamento']) ? $employeeData[0]['departamento'] : '' ?>`;
            cargo.value = `<?php echo isset($employeeData[0]['tipo']) ? $employeeData[0]['tipo'] : '' ?>`;
            descripcion.value = `<?php echo isset($direcionData[0]['descripcion']) ? $direcionData[0]['descripcion'] : '' ?>`;


        }


        function increaseInputLenght(event) {
            const input = event.target
            input.style.width = input.value.length + 7 + "ch";
        }

        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('.submain-data input');
    
            inputs.forEach(input => {
                increaseInputLenght({ target: input });
            });
            asignSelect()
            initializePlanillaCalculators(document.querySelector('.parent-container-viewEmployeeData'))

        })

        inputs.forEach(input => {
            input.addEventListener('input', increaseInputLenght);
        });
        
    </script>

@endsection

