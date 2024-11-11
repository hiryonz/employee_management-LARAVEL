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
            logo='<i class="fa-solid fa-circle-exclamation"></i>'
            :countPersonal="$countPersonal"
            :totalPersonal="$totalPersonal"
        />
        <x-small-container 
            class="container2"   
            name="Reportes"
            logo='<i class="fa-solid fa-bell"></i>'
            :reportes="$reportes"
        />
        <x-small-container  
            class="container3"
            name="Anuncios"
            logo='<i class="fa-solid fa-envelope"></i></i>'
            :anuncios="$anuncios"
        />

    </div>

    
    <div class="container-employee-time scrollContainer" >
        <div class="tables">
            <x-tables-layout name="employee" :employee="$employee"></x-tables-layout>
        </div>
    </div>

    <div class="container-employee-time-graph">
        <x-graph1 :labels="$labels" :dataDescuento="$dataDescuento" />
    </div>
    
    <div class="container-employee-task scrollContainer" >
        <div class="tables">
            <x-tables-layout name="task" :task="$task"></x-tables-layout>
        </div>
    </div>

    <div class="container-employee-task-graph">
        <h2>4</h2>
    </div>
</div>


@endsection