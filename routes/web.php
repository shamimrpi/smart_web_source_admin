<?php

use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/city_upload',[CityController::class,'city_upload'])->name('city_upload');
    Route::post('/city_upload',[CityController::class,'upload'])->name('upload');
    Route::get('/city_list',[CityController::class,'city_list'])->name('city_list');
    Route::get('/city_show/{id}',[CityController::class,'show'])->name('city_show');
});
