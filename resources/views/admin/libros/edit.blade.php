@extends('layouts.dashboard')

@section('title', 'Editar Libro')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Editar Libro</h1>

    <form action="{{ route('admin.libros.update', $libro->id_libro) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block">Título:</label>
            <input type="text" name="titulo" class="w-full border rounded px-3 py-2" value="{{ $libro->titulo }}" required>
        </div>

        <div>
            <label class="block">Autor:</label>
            <select name="author_id" class="w-full border rounded px-3 py-2" required>
                @foreach ($autores as $autor)
                    <option value="{{ $autor->id }}" {{ $autor->id == $libro->author_id ? 'selected' : '' }}>
                        {{ $autor->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Categoría:</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $categoria->id == $libro->category_id ? 'selected' : '' }}>
                        {{ $categoria->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">ISBN:</label>
            <input type="text" name="isbn" class="w-full border rounded px-3 py-2" value="{{ $libro->isbn }}" required>
        </div>

        <div>
            <label class="block">Fecha de Publicación:</label>
            <input type="date" name="publicacion" class="w-full border rounded px-3 py-2" value="{{ $libro->publicacion }}">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
