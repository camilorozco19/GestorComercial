<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
// Página principal
Route::get('/', function () {
    return view('dashboard');
});

// Módulo de productos
Route::get('/productos', [ProductoController::class, 'index'])
    ->name('productos.index');

Route::post('/productos', [ProductoController::class, 'store'])
    ->name('productos.store');

Route::put('/productos/{id}', [ProductoController::class, 'update'])
    ->name('productos.update');

Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])
    ->name('productos.destroy');

Route::get('/productos/crear', [ProductoController::class, 'create'])
    ->name('productos.create');

Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])
    ->name('productos.edit');

// Módulo de categorías
Route::get('/categorias', [CategoriaController::class, 'index'])
    ->name('categorias.index');

Route::get('/categorias/crear', [CategoriaController::class, 'create'])
    ->name('categorias.create');

Route::post('/categorias', [CategoriaController::class, 'store'])
    ->name('categorias.store');

Route::get('/categorias/{id}/editar', [CategoriaController::class, 'edit'])
    ->name('categorias.edit');

Route::put('/categorias/{id}', [CategoriaController::class, 'update'])
    ->name('categorias.update');

Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])
    ->name('categorias.destroy');    


// Módulo de clientes
Route::get('/clientes', [ClienteController::class, 'index'])
    ->name('clientes.index');

Route::get('/clientes/crear', [ClienteController::class, 'create'])
    ->name('clientes.create');

Route::post('/clientes', [ClienteController::class, 'store'])
    ->name('clientes.store');

Route::get('/clientes/{id}/editar', [ClienteController::class, 'edit'])
    ->name('clientes.edit');

Route::put('/clientes/{id}', [ClienteController::class, 'update'])
    ->name('clientes.update');

Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])
    ->name('clientes.destroy');    