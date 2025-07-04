@extends('layouts.dashboard')

@section('title', 'Gestión de Libros')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Libros Registrados</h1>
        <a href="{{ route('admin.libros.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nuevo Libro
        </a>
    </div>

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Título</th>
                <th class="px-4 py-2 border">Autor</th>
                <th class="px-4 py-2 border">Categoría</th>
                <th class="px-4 py-2 border">ISBN</th>
                <th class="px-4 py-2 border">Publicación</th>
                <th class="px-4 py-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($libros as $libro)
                <tr>
                    <td class="border px-4 py-2">{{ $libro->titulo }}</td>
                    <td class="border px-4 py-2">{{ $libro->author->name }}</td>
                    <td class="border px-4 py-2">{{ $libro->category->name }}</td>
                    <td class="border px-4 py-2">{{ $libro->isbn }}</td>
                    <td class="border px-4 py-2">{{ $libro->publicacion }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.libros.edit', $libro->id_libro) }}" class="text-blue-600 hover:underline mr-2 inline-flex items-center">
                            ✏️ Editar
                        </a>
                        <form action="{{ route('admin.libros.destroy', $libro->id_libro) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este libro?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline inline-flex items-center">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No hay libros registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
