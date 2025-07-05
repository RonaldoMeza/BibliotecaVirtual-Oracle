@extends('layouts.dashboard')

@section('title', 'Nueva Categoría')

@section('content')
<div class="max-w-md mx-auto">
    <h1 class="text-xl font-bold mb-4">Nueva Categoría</h1>

    <form action="{{ route('admin.categorias.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-semibold">Nombre</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
    </form>
</div>
@endsection
