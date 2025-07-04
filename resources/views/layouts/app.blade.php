<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>@yield('title','Biblioteca Virtual')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white text-gray-800 flex flex-col min-h-screen">
    <header class="bg-blue-600 text-white p-4">
    <a href="{{ url('/') }}" class="text-lg font-bold">Biblioteca Virtual</a>
    @auth
        <form method="POST" action="{{ route('logout') }}" class="inline float-right">
        @csrf
        <button type="submit" class="">Cerrar sesión</button>
        </form>
    @endauth
    </header>
    <main class="p-6">
        @yield('content')
    </main>
    <footer class="text-center bg-blue-600 text-sm text-white p-4 mt-auto">
        &copy; {{ date('Y') }} Biblioteca
    </footer>
</body>
</html>
