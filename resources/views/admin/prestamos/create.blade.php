@extends('layouts.dashboard')

@section('title', 'Asignar Préstamo')

@section('content')
<div class="max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Asignar Préstamo</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-2 mb-4">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.prestamos.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="user_id" class="block font-semibold">Usuario</label>
            <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Seleccionar usuario</option>
                @foreach($usuarios as $u)
                    <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="libro_id" class="block font-semibold">Libro</label>
            <select name="libro_id" id="libro_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Seleccionar libro</option>
                @foreach($libros as $l)
                    <option value="{{ $l->id_libro }}">{{ $l->titulo }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Asignar Préstamo
        </button>
    </form>
</div>
@endsection
