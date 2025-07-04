@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>
    <form action="{{ route('admin.usuarios.update', ['user' => $user->id]) }}" method="POST" class="space-y-4">

        @csrf 
        @method('PUT')
        <div>
        <label>Nombre</label>
        <input type="text" name="name" value="{{ old('name',$user->name) }}"
                class="w-full border p-2 rounded" required>
        @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>
        <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email',$user->email) }}"
                class="w-full border p-2 rounded" required>
        @error('email')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>
        <div>
        <label>Nueva Contraseña (opcional)</label>
        <input type="password" name="password"
                class="w-full border p-2 rounded">
        @error('password')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>
        <div>
        <label>Confirmar Contraseña</label>
        <input type="password" name="password_confirmation"
                class="w-full border p-2 rounded">
        </div>
        <div>
        <label>Roles</label>
        @foreach($roles as $rol)
            <label class="inline-flex items-center mr-4">
            <input type="checkbox" name="roles[]" value="{{ $rol->id }}"
                @checked(in_array($rol->id, $ur)) class="mr-1">
            <span>{{ $rol->name }}</span>
            </label>
        @endforeach
        @error('roles')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
    </form>
</div>
@endsection
