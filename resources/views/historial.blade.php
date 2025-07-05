@extends('layouts.app')

@section('title', 'Historial de Préstamos')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Mi Historial de Préstamos</h1>

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">Libro</th>
                <th class="px-4 py-2 border">Fecha Préstamo</th>
                <th class="px-4 py-2 border">Fecha Devolución</th>
                <th class="px-4 py-2 border">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($historial as $i => $p)
                <tr>
                    <td class="border px-4 py-2">{{ $i + 1 }}</td>
                    <td class="border px-4 py-2">{{ $p->titulo }}</td>
                    <td class="border px-4 py-2">{{ $p->fecha_prest }}</td>
                    <td class="border px-4 py-2">
                        {{ $p->fecha_devolucion ?? 'No devuelto' }}
                    </td>
                    <td class="border px-4 py-2">{{ $p->estado }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Sin préstamos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
