<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    LoginController, HomeController, ProfileController, AppointmentController, ServiceController
};

Route::get('/', function (Request $request) {
    return response()->json([
        'success'=>true,
    ]);
});


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout/{user}', [LoginController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::resource('/profile', ProfileController::class);
    Route::resource('/appointments', AppointmentController::class);
    Route::resource('/services', ServiceController::class);


});

