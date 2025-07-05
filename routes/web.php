<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RoleMiddleware;


Route::get('/', function () {
    // Si no está autenticado, va al login
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    // Si es bibliotecario, al dashboard
    if (Auth::user()->roles->contains('name', 'BIBLIOTECARIO')) {
        return redirect()->route('dashboard');
    }

    // Si es usuario normal, a home
    return redirect()->route('home');
});

// Públicas
Route::get('/login',[AuthController::class,'showLoginForm'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.post');
Route::get('/register',[AuthController::class,'showRegisterForm'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register.post');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

// Protegidas por rol
Route::get('/dashboard', [HomeController::class,'dashboard'])
    ->middleware(['auth', RoleMiddleware::class . ':BIBLIOTECARIO'])
    ->name('dashboard');

Route::get('/home', [HomeController::class,'home'])
    ->middleware(['auth', RoleMiddleware::class . ':USUARIO'])
    ->name('home');

// CRUD usuarios (solo BIBLIOTECARIO)
Route::middleware(['auth', RoleMiddleware::class . ':BIBLIOTECARIO'])->group(function(){
    Route::resource('admin/usuarios', UserController::class)
    ->parameters(['usuarios' => 'user']) // 👈 Forzamos Laravel a usar 'user'
    ->names('admin.usuarios');

    Route::resource('admin/autores', AuthorController::class)
    ->parameters(['autores' => 'autor']) // 👈 Esto lo soluciona
    ->names('admin.autores');
    Route::resource('admin/categorias', CategoryController::class)->names('admin.categorias');

    Route::resource('admin/libros', LibroController::class)->names('admin.libros');


    Route::get('admin/prestamos', [PrestamoController::class, 'index'])->name('admin.prestamos.index');
    Route::get('admin/prestamos/create', [PrestamoController::class, 'create'])->name('admin.prestamos.create');
    Route::post('admin/prestamos', [PrestamoController::class, 'store'])->name('admin.prestamos.store');

    Route::post('admin/prestamos/{id}/devolver', [PrestamoController::class, 'devolver'])
    ->name('admin.prestamos.devolver');
});

// HISTORIAL DE PRÉSTAMOS PARA USUARIO NORMAL
Route::middleware(['auth', RoleMiddleware::class . ':USUARIO'])
    ->get('/historial', [PrestamoController::class, 'historial'])->name('usuario.historial');
