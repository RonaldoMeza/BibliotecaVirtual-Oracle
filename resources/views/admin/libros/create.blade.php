@extends('layouts.dashboard')

@section('title', 'Registrar Libro')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Registrar Nuevo Libro</h1>

    <form action="{{ route('admin.libros.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block">Título:</label>
            <input type="text" name="titulo" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block">Autor:</label>
            <select name="author_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Seleccione un autor</option>
                @foreach ($autores as $autor)
                    <option value="{{ $autor->id }}">{{ $autor->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Categoría:</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Seleccione una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">ISBN:</label>
            <input type="text" name="isbn" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block">Fecha de Publicación:</label>
            <input type="date" name="publicacion" class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection
