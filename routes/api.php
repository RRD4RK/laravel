<?php

use App\Http\Controllers\API\ExploradorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/explorador', [ExploradorController::class, "store"]);

Route::put('/explorador/{id}', [ExploradorController::class, 'update']);

Route::post('/explorador/{id}/inventario', [ExploradorController::class,'adicionarItem']);

Route::post('/explorador/trocar', [ExploradorController::class, 'trocarItens']);
