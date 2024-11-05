@extends('layout')

@section('title', 'empleado')
@section('content')


    <x-tables-layout name="employee" :combinedData="$combinedData"></x-tables-layout>

@endsection

