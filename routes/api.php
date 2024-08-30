<?php

use App\Http\Controllers\api\userController;
use App\Http\Controllers\api\ProductosController;
use App\Http\Controllers\api\PokemonesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Ruta de el login
Route::post('user/login', [UserController::class, 'login']);

Route::post('usuario', [userController::class, 'create']);

//  middleware de autenticación
Route::group(['middleware' => ['auth:sanctum']], function() {

    // Rutas para los usuarios
    Route::prefix('usuario')->group(function() {
        Route::get('', [userController::class, 'index']); // Obtener todos los usuarios
        Route::post('', [userController::class, 'create']); // Crear un nuevo usuario
        Route::get('/{id}', [userController::class, 'show'])->where('id', '[0-9]+'); // Mostrar un usuario por ID
        Route::patch('/{id}', [userController::class, 'update'])->where('id', '[0-9]+'); // Actualizar un usuario por ID
        Route::delete('/{id}', [userController::class, 'destroy'])->where('id', '[0-9]+'); // Eliminar un usuario por ID
    });

    // Rutas para los Pokémon
    Route::prefix('pokemon')->group(function() {
        Route::get('', [pokemonescontroller::class, 'index']); // Obtener todos los Pokémon
        Route::post('', [pokemonescontroller::class, 'create']); // Crear un nuevo Pokémon
        Route::get('/{id}', [pokemonescontroller::class, 'show'])->where('id', '[0-9]+'); // Mostrar un Pokémon por ID
        Route::patch('/{id}', [pokemonescontroller::class, 'update'])->where('id', '[0-9]+'); // Actualizar un Pokémon por ID
        Route::delete('/{id}', [pokemonescontroller::class, 'destroy'])->where('id', '[0-9]+'); // Eliminar un Pokémon por ID
    });
});

// Obtener al usuario autenticado
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
