@extends('layouts.dashboard')

@section('title', 'Categorías')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Categorías</h1>
        <a href="{{ route('admin.categorias.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            ➕ Nueva Categoría
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $cat)
                <tr>
                    <td class="border px-4 py-2">{{ $cat->name }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.categorias.edit', $cat) }}" class="text-blue-600 hover:underline">✏️</a>
                        <form action="{{ route('admin.categorias.destroy', $cat) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar categoría?');">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
