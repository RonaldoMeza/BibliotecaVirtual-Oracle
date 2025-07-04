@extends('layouts.app')

@section('title','Inicio - Biblioteca')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Catálogo de Libros</h1>

    <table class="min-w-full bg-white">
        <thead>
        <tr>
            <th class="px-4 py-2 border">ID</th>
            <th class="px-4 py-2 border">Título</th>
            <th class="px-4 py-2 border">Autor</th>
            <th class="px-4 py-2 border">Categoría</th>
            <th class="px-4 py-2 border">ISBN</th>
            <th class="px-4 py-2 border">Publicado</th>
        </tr>
        </thead>
        <tbody>
        @forelse($books as $book)
            <tr>
                <td class="border px-4 py-2">{{ $book->id_libro }}</td>
                <td class="border px-4 py-2">{{ $book->titulo }}</td>
                <td class="border px-4 py-2">{{ $book->author->name ?? '—' }}</td>
                <td class="border px-4 py-2">{{ $book->category->name ?? '—' }}</td>
                <td class="border px-4 py-2">{{ $book->isbn }}</td>
                <td class="border px-4 py-2">{{ $book->publicacion }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center p-4">No hay libros disponibles.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
