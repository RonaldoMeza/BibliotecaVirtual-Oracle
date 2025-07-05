@extends('layouts.app')

@section('title','Inicio - Biblioteca')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Catálogo de Libros</h1>

    <table class="min-w-full bg-white mb-8">
        <thead>
            <tr>
                {{-- <th class="px-4 py-2 border">ID</th> --}}
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
                    {{-- <td class="border px-4 py-2">{{ $book->id_libro }}</td> --}}
                    <td class="border px-4 py-2">{{ $book->titulo }}</td>
                    <td class="border px-4 py-2">{{ $book->author->name ?? '—' }}</td>
                    <td class="border px-4 py-2">{{ $book->category->name ?? '—' }}</td>
                    <td class="border px-4 py-2">{{ $book->isbn }}</td>
                    {{-- formato dia mes año --}}
                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($book->publicacion)->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4">No hay libros disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if(count($historial))
    <h2 class="text-xl font-semibold mt-10 mb-2">📖 Historial de Préstamos</h2>
    <table class="min-w-full bg-white border mt-2">
        <thead>
            <tr>
                <th class="border px-4 py-2">Título</th>
                <th class="border px-4 py-2">Fecha Préstamo</th>
                <th class="border px-4 py-2">Fecha Devolución</th>
                <th class="border px-4 py-2">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($historial as $h)
                <tr>
                    <td class="border px-4 py-2">{{ $h['TITULO'] }}</td>
                    <td class="border px-4 py-2">{{ $h['FECHA_PRESTAMO'] }}</td>
                    <td class="border px-4 py-2">{{ $h['FECHA_DEVOLUCION'] ?? '—' }}</td>
                    <td class="border px-4 py-2">{{ $h['ESTADO'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

@endsection
