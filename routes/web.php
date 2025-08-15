<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Base\HomeController;


Route::get('/', [HomeController::class, 'index']);
