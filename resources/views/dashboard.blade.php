@extends('layouts.dashboard')

@section('title', 'Panel de Administración')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Panel de Administración</h1>
    <p>Bienvenido, {{ Auth::user()->name }}.</p>
@endsection
