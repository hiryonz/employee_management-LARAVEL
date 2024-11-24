@extends('layout')
@section('title', 'home')
@section('content')

<?php
    $reportes = "ohola";
    $anuncios = "hola";
?>


<div class="parent-container-home">

    <div class="parent-container-general-info">
        <x-small-container  
            class="container1"
            name="Empleados Presentes"
            info="1"
            logo='<i class="fa-solid fa-circle-exclamation"></i>'
            :first="$countPersonal"
            :second="$totalPersonal"
        />
        <x-small-container 
            class="container2"   
            name="Faltas mensual"
            info="2"
            logo='<i class="fa-solid fa-clipboard-user"></i>'
            :third="$totalHorasFaltas"
        />
        <x-small-container 
            class="container3"   
            name="tareas por revisar"
            info="2"
            logo='<i class="fa-solid fa-magnifying-glass"></i>'
            :third="$reviewTask"
        />
        <x-small-container 
            class="container4"   
            name="tareas pendientes"
            info="2"
            logo='<i class="fa-solid fa-list-check"></i>'
            :third="$taskCount"
        />

    </div>

    
    <div class="container-employee-time scrollContainer" >
        <div class="tables">
            <x-tables-layout name="employee" :employee="$employee"></x-tables-layout>
        </div>
    </div>

    <div class="container-employee-time-graph">
        <x-graph1 id="time" :labels="$labels" :data="$dataDescuento" />
    </div>
    
    <div class="container-employee-task scrollContainer" >
        <div class="tables">
            <x-tables-layout name="task" :task="$task"></x-tables-layout>
        </div>
    </div>
    <?php

?>
    <div class="container-employee-task-graph">
        <x-graph1 id="task" :labels="$labelsTask" :data="$allTask" />
    </div>
</div>


@endsection