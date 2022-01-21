<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// Route::post('logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('register', [AuthController::class, 'register'])->name('register');
// Route::post('login', [AuthController::class, 'login'])->name('login');


// Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'api'], function () {
//     Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');
//     Route::post('user', function (Request $request) {
//         dd($request);
//     })->name('user');
// });



// Route::post('user', function (Request $request) {
//     dd($request);
// })->name('user');
Route::group(['middleware' => 'api'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/profile', [AuthController::class, 'profile']);
    Route::get('/user', [AuthController::class, 'user'])->name('user');
});
Route::group(['middleware' => ['web']], function () {
    Route::get('/google/auth', [GoogleAuthController::class, 'redirect'])->name('google.login');
    Route::get('/google/callback', [GoogleAuthController::class, 'callback']);
});
