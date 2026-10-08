<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PictogramController;

Route::get('/buscar-pictogramas', [PictogramController::class, 'buscar']);