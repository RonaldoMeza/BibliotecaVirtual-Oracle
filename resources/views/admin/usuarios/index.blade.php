@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Gestión de Usuarios</h1>
    <a href="{{ route('admin.usuarios.create') }}"
        class="bg-green-600 text-white px-4 py-2 rounded">Nuevo Usuario</a>
    @if(session('success'))
        <div class="mt-4 p-2 bg-green-200">{{ session('success') }}</div>
    @endif
    <table class="min-w-full bg-white mt-4">
        <thead>
        <tr>
            {{-- <th class="px-4 py-2">ID</th> --}}
            <th class="px-4 py-2">Nombre</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Roles</th>
            <th class="px-4 py-2">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $u)
        <tr>
            {{-- <td class="border px-4 py-2">{{ $u->id }}</td> --}}
            <td class="border px-4 py-2">{{ $u->name }}</td>
            <td class="border px-4 py-2">{{ $u->email }}</td>
            <td class="border px-4 py-2">{{ $u->roles->pluck('name')->join(', ') }}</td>
            <td class="border px-4 py-2">
            <a href="{{ route('admin.usuarios.edit', $u) }}" class="text-blue-600">✏️ Editar</a>
            <form action="{{ route('admin.usuarios.destroy', ['user' => $u->id]) }}" method="POST">
                @csrf 
                @method('DELETE')
                <button type="submit" class="text-red-600 ml-2">🗑️ Eliminar</button>
            </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
