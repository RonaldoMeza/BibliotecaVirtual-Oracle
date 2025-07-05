@extends('layouts.dashboard')

@section('title', 'Préstamos Registrados')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Préstamos Registrados</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 mb-4">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.prestamos.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        ➕ Nuevo Préstamo
    </a>

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Usuario</th>
                <th class="border px-4 py-2">Libro</th>
                <th class="border px-4 py-2">Fecha Préstamo</th>
                <th class="border px-4 py-2">Fecha Devolución</th>
                <th class="border px-4 py-2">Estado</th>
                <th class="border px-4 py-2">Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prestamos as $p)
            <tr>
                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2">{{ $p->usuario }}</td>
                <td class="border px-4 py-2">{{ $p->titulo }}</td>
                <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($p->fecha_prestamo)->format('d/m/Y') }}</td>
                <td class="border px-4 py-2">{{ $p->fecha_devolucion ? \Carbon\Carbon::parse($p->fecha_devolucion)->format('d/m/Y') : '—' }}</td>
                <td class="border px-4 py-2">
                    <span class="px-2 py-1 rounded {{ $p->estado == 'PRESTADO' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                        {{ $p->estado }}
                    </span>
                </td>
                <td class="border px-4 py-2">
                    @if($p->estado === 'PRESTADO')
                        <form action="{{ route('admin.prestamos.devolver', $p->id_prestamo) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Confirmar devolución?');">
                            @csrf
                            <button class="text-green-600 hover:underline inline-flex items-center">
                                ✔️ Devolver
                            </button>
                        </form>
                    @else
                        <span class="text-gray-400">✔️ Devuelto</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-4">No hay préstamos registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
