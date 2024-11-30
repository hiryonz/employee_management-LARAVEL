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

    @if (auth()->check() && auth()->user()->employee->tipo === "admin")
        <div class="finder-container-EmployeeData">
            <x-search-bar :employeeData="$smallEmployeeData"></x-search-bar>
        </div>
    @endif   
        


        <div class="btn-container-employeeData ">
        @if (auth()->check() && auth()->user()->employee->tipo === "admin")

            <div class="d-flex">
                <form class="ms-2 me-2" style="width: 100px" action="{{ route('destroyEmployee.post', ['id' => $employeeData->cedula]) }}"
                    onsubmit="return confirm('¿Seguro que deseas eliminar al empleado con cédula {{ $employeeData->cedula }}?')"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Eliminar</button>
                </form>
                <button type="button" class="btn btn-light me-4" data-bs-toggle="modal" data-bs-target="#Actualizar">Actualizar</button>
                <button class="btn btn-light me-4" data-bs-toggle="modal" data-bs-target="#historial">Ver Historial</button>
            </div>

            
            @include('include.modals.modal-actualizacion')
            @include('include.modals.modal-historialDescuento')
            
            @endif
            
            @include('include.modals.modal-actualizarImg')
        <div id="data_principal">
            <x-employee-data-detailed 
                name="principal"
                :employeeData="$employeeData"
                :direcionData="$direcionData"
                :planillaData="$planillaData"
                :userData="$userData"
                :faltas="$faltas"
                :QR="$QR"/>
        </div>
    </div>
    </div>

    <div class="graph-data">
        <div class="time-container-data">
            <div class="container-employee-time-graph">
            <h5 class="h5-title">Faltas</h5>
                <x-graph2 id="detailed_data" :mesFalta="$mesFalta" :semanaFalta="$semanaFalta"></x-graph2>
            </div>
        </div>

        <div class="task-container-data">
            <div class="container-employee-task-graph">
                <h5 class="h5-title">Tareas pendientes</h5>
                @if (auth()->user()->employee->tipo === 'admin')
                    <x-graph1 id="task" :labels="$labelsTask2" :data="$task2" />
                @else
                    <x-graph1 id="task" :labels="$labelsTask" :data="$task" />
                @endif
            </div>
        </div>
    </div>

</div>

@include('include.javascript.tables')

<script>
    const inputs = document.querySelectorAll('.form-control');


    function asignSelect(form) {
        console.log(form)
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
        console.log(event)
        const input = event.target;
        input.style.width = input.value.length + 7 + "ch";
        console.log(input)
    }

    document.addEventListener('DOMContentLoaded', () => {
        const inputs1 = document.querySelectorAll('.submain-data input, .submain-data select');
 
        const inputs2 = document.querySelectorAll('.modal-body .submain-data input, .modal-body .submain-data select');

        const form = document.getElementById('data_principal');
        const formModal = document.querySelector('#Actualizar .modal-body');

        inputs1.forEach(input => {
            input.addEventListener('input', increaseInputLenght);
        });

        inputs2.forEach(input => {
            input.addEventListener('input', increaseInputLenght);
        });

        if(form) asignSelect(form);
        if(formModal) asignSelect(formModal);
        initializePlanillaCalculators(document.querySelector('.parent-container-viewEmployeeData'));
    });





    const dataDescuento = @json($descuentoFalta);
    function filterByDate(date) {
        let startDate = '1000-01-01';
        let endDate = '9999-12-31';

        if (!date || date === '') {
            startDate = document.getElementById('startDate').value || startDate;
            endDate = document.getElementById('endDate').value || endDate;
        }

        // Filtrar los datos
        const filteredData = dataDescuento.filter(item => {
            return item.fecha >= startDate && item.fecha <= endDate;
        });

        console.log('Datos filtrados:', filteredData);

        // Actualizar la tabla con los datos filtrados
        updateTable(filteredData);
    }

// Función para actualizar la tabla
function updateTable(filteredData) {
    const tableBody = document.querySelector('#table-container tbody');
    tableBody.innerHTML = ''; // Limpiar la tabla existente

    if (filteredData.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="100%">No hay datos que mostrar.</td></tr>';
        return;
    }

    filteredData.forEach(row => {
        const tr = document.createElement('tr');

        Object.values(row).forEach(value => {
            const td = document.createElement('td');
            td.textContent = value === '00:00:00' ? 'N/A' : value;
            tr.appendChild(td);
        });

        tableBody.appendChild(tr);
    });
}
</script>
@endsection
