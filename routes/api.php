<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    LoginController, RegisterController, HomeController, ProfileController, AppointmentController, ServiceController
};

Route::get('/', function (Request $request) {
    return response()->json([
        'success'=>true,
    ]);
});

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout/{user}', [LoginController::class, 'logout']);

Route::post('/register', [RegisterController::class, 'store']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::Apiresource('/profile', ProfileController::class);
    Route::delete('/delete-profile/{id}', [ProfileController::class, 'deleteAcount']);
    Route::Apiresource('/appointments', AppointmentController::class);
    Route::Apiresource('/services', ServiceController::class);


});

