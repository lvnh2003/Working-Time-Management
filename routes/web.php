<?php

use App\Http\Controllers\LoginController;
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


// Login
Route::group(['controller' => LoginController::class],function(){
    Route::get('/','index')->name('login');
    Route::post('/','login')->name('loginAction');
    Route::get('/signup','signup')->name('signup');
    Route::post('/signup','signupAction')->name('signupAction');
    Route::get('/active/{token}','active')->name('active');
});
Route::get('/home',function(){
    return view('welcome');
})->name('home');