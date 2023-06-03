<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
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
// user
Route::group(['controller' => UserController::class],function(){
    Route::get('/home','index')->name('home');
    Route::post('/home/{id}','update')->name('user.update');
});
// project
Route::group(['controller' => ProjectController::class, 'prefix' => 'project', 'as' => 'project.'], function () {
    Route::get('/', 'index')->name('index');
    Route::post('/store','store')->name('store');
    Route::put('/update/{id}', 'update')->name('update');
    Route::put('/updateValue/{id}', 'updateValue')->name('updateValue');
    Route::delete('/destroy/{id}', 'destroy')->name('destroy');
});
// admin
Route::group(['controller' => AdminController::class,'prefix'=>'admin','as'=>'admin.'],function(){
    Route::get('/',function(){
        return view('admin.index');
    })->name('index');
    Route::get('/getUser','getAllUsers')->name('getAllUsers');
    Route::get('/customer','customer')->name('customer');
    Route::get('/customer/create','create')->name('customer.create');
    Route::post('/customer/create','storeCustomer')->name('customer.store');
    Route::get('/active/{token}','active')->name('customer.active');
});

