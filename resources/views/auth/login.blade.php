<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-sm bg-white p-6 rounded shadow">
        <h2 class="text-xl mb-4 text-center">Iniciar Sesión</h2>
        <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
        @csrf
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
            <label class="block mb-1 font-semibold">Ingresar como:</label>
            <label class="inline-flex items-center mr-4">
            <input type="radio" name="role" value="BIBLIOTECARIO" required class="mr-1">
            <span>Bibliotecario</span>
            </label>
            <label class="inline-flex items-center">
            <input type="radio" name="role" value="USUARIO" required class="mr-1">
            <span>Usuario</span>
            </label>
            @error('role')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Entrar</button>
        <p class="mt-4 text-center text-sm">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-blue-600">Regístrate</a>
        </p>
        </form>
    </div>
</body>
</html>
