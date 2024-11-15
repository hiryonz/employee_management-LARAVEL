@extends('layout')
@section('title', 'home')
@section('content')


<?php
    $reportes = "ohola";
    $anuncios = "hola";
?>


<div class="parent-container-home-employee">

    

    <div class="parent-container-general-info">

    <?php 
        $countPersonal = $descuentoFaltas->total_horas_faltas;
        $descuento = $descuentoFaltas->total_descuento;    
    ?>
        <x-small-container  
            class="container1"
            name="Tus faltas mensual"
            info='1'
            logo='<i class="fa-solid fa-circle-exclamation"></i>'
            :first="$countPersonal"
        />
        <x-small-container 
            class="container2"   
            name="Descuentos por falta mensual"
            info='2'
            logo='<i class="fa-solid fa-clipboard-user"></i>'
            :third="$descuento"
        />
        <x-small-container 
            class="container3"   
            name="tareas por revisar"
            info="2"
            logo='<i class="fa-solid fa-magnifying-glass"></i>'
            :third="$descuento"
        />
        <x-small-container 
            class="container4"   
            name="tareas pendientes"
            info="2"
            logo='<i class="fa-solid fa-list-check"></i>'
            :third="$descuento"
        />

    </div>

    <div class="container-employee-time-graph">
        <x-graph2 id="detailed_data" :mesFalta="$mesFalta" :semanaFalta="$semanaFalta"></x-graph2>
    </div>
    
    <div class="container-employee-task scrollContainer" >
        <div class="tables">
        </div>
    </div>

</div>


@endsection