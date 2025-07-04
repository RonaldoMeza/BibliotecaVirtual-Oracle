<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Registro</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-sm bg-white p-6 rounded shadow">
        <h2 class="text-xl mb-4 text-center">Crear Cuenta</h2>
        <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
        @csrf
        <div>
            <label>Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full border p-2 rounded" required>
            @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full border p-2 rounded" required>
            @error('email')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>
        <div>
            <label>Contraseña</label>
            <input type="password" name="password"
                class="w-full border p-2 rounded" required>
            @error('password')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>
        <div>
            <label>Confirmar Contraseña</label>
            <input type="password" name="password_confirmation"
                class="w-full border p-2 rounded" required>
        </div>
        <button type="submit" class="w-full bg-green-600 text-white p-2 rounded">Registrarme</button>
        <p class="mt-4 text-center text-sm">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-blue-600">Entrar</a>
        </p>
        </form>
    </div>
</body>
</html>
