<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>@yield('title', 'Biblioteca Virtual')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
<div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r hidden md:block">
        <div class="p-4 font-bold text-xl border-b text-center">📚 Biblioteca</div>

        <nav class="p-4 space-y-2">
            @php
                $user = auth()->user();
            @endphp

            @if($user && $user->roles->contains('name','BIBLIOTECARIO'))
                <a href="{{ route('dashboard') }}" class="block p-2 rounded hover:bg-gray-200">🏠 Dashboard</a>
                <a href="{{ route('admin.libros.index') }}" class="block p-2 rounded hover:bg-gray-200">📘 Libros</a>
                <a href="{{ route('admin.usuarios.index') }}" class="block p-2 rounded hover:bg-gray-200">👥 Usuarios</a>
                {{-- <a href="{{ route('admin.prestamos.index') }}" class="block p-2 rounded hover:bg-gray-200">📖 Préstamos</a> --}}
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left p-2 rounded hover:bg-red-100 text-red-600 mt-auto">
                    🚪 Cerrar sesión
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-6 overflow-auto">
        <div class="mb-4 text-sm text-right text-gray-500">
            @if($user)
                Sesión: <span class="font-semibold">{{ $user->name }} ({{ $user->roles->pluck('name')->join(', ') }})</span>
            @endif
        </div>

        @yield('content')
    </main>
</div>
</body>
</html>
