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
            <x-search-bar :employeeData="$smallEmployeeData"></x-search-bar>
        </div>


        <div class="btn-container-employeeData d-flex">
            <form class="d-flex" style="width: 100px" action="{{ route('destroyEmployee.post', ['id' => $employeeData->cedula]) }}"
                onsubmit="return confirm('¿Seguro que deseas eliminar al empleado con cédula {{ $employeeData->cedula }}?')"
                method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger ml-2 mr-4">Eliminar</button>
            </form>
            <button type="button" class="btn btn-light mr-4" data-toggle="modal" data-target="#Actualizar">Actualizar</button>
            <button class="btn btn-light mr-4">Ver Historial</button>

            <x-error-management/>

            <!-- Modal de Actualización -->
            <div class="modal fade" id="Actualizar" tabindex="-1" role="dialog" aria-labelledby="ActualizarLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content custom-modal-width">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ActualizarLabel">Actualizar Datos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php $route = route('updateEmployee.post', ['id' => $employeeData->cedula]); ?>

                        <form class="submain-data" action="{{ $route }}" method="post">
                            <div class="modal-body">
                                <x-employee-data-detailed 
                                    :route="$route"
                                    :employeeData="$employeeData"
                                    :direcionData="$direcionData"
                                    :planillaData="$planillaData"
                                    :userData="$userData"/>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="data_principal">
            <x-employee-data-detailed 
                :employeeData="$employeeData"
                :direcionData="$direcionData"
                :planillaData="$planillaData"
                :userData="$userData"
                :QR="$QR"/>
        </div>
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

    function asignSelect(form) {
        const departamento = form.querySelector('#departamento');
        const cargo = form.querySelector('#tipo');
        const descripcion = form.querySelector('#descripcion');
        const id_turno = form.querySelector('#turno');
        
        id_turno.value = `{{ $employeeData->id_turno ?? '' }}`;
        departamento.value = `{{ $employeeData->departamento ?? '' }}`;
        cargo.value = `{{ $employeeData->tipo ?? '' }}`;
        descripcion.value = `{{ $direcionData->descripcion ?? '' }}`;
    }

    function increaseInputLenght(event) {
        const input = event.target;
        input.style.width = input.value.length + 7 + "ch";
    }

    document.addEventListener('DOMContentLoaded', () => {
        const inputs = document.querySelectorAll('.submain-data input');
        const inputs2 = document.querySelectorAll('.modal-body .submain-data input');

        const form = document.getElementById('data_principal');
        const formModal = document.querySelector('.modal-body');

        inputs.forEach(input => {
            increaseInputLenght({ target: input });
        });

        inputs2.forEach(input => {
            increaseInputLenght({ target: input });
        });

        asignSelect(form);
        asignSelect(formModal);
        initializePlanillaCalculators(document.querySelector('.parent-container-viewEmployeeData'));
    });

    inputs.forEach(input => {
        input.addEventListener('input', increaseInputLenght);
    });
</script>
@endsection
