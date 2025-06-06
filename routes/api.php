<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

// POST
Route::post('/usuarios', [UsuarioController::class, 'store']); // insert user

// GET
Route::get('/usuarios', [UsuarioController::class, 'index']); // search all users

Route::get('/usuarios/email/{email}', [UsuarioController::class, 'buscarPorEmail']); // search user for email

Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->where('id', '[0-9]+'); // search user for id

//PUT
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']); // update data for user

//DELETE
Route::delete('/usuarios/{id}', [UsuarioController::class, 'delete']); // delete data for user

