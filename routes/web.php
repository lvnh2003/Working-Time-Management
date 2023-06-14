<?php

use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\CreatorController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Creator\CreatorController as CreatorCreatorController;
use App\Http\Controllers\Creator\ProjectController;
use App\Http\Controllers\LoginController;
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
Route::group(['controller' => LoginController::class], function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('loginAction');
    Route::get('/signup', 'signup')->name('signup');
    Route::post('/signup', 'signupAction')->name('signupAction');
    Route::get('/active/{token}', 'active')->name('active');
    Route::get('/logout','logout')->name('logout');
    Route::get('/forgot','forgot')->name('forgot');
    Route::post('/forgot','sendMail')->name('forgot.sendMail');
    Route::get('/reset/{token}', 'reset')->name('reset');
    Route::post('/reset/{token}', 'update')->name('forgot.reset');
});
Route::middleware('IsCreatorLogin')->group(function () {
    // user
    Route::group(['controller' => CreatorCreatorController::class],function(){
        Route::get('/', 'index')->name('home');
        Route::post('/', 'update')->name('user.update');
    });
    // project
    Route::group(['controller' => ProjectController::class, 'prefix' => 'project', 'as' => 'project.'], function () {
        Route::get('/{id}', 'index')->name('index');
        Route::get('/{id}/{idNotification}', 'index')->name('index.notification');
        Route::post('/store', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
        Route::put('/updateValue/{id}', 'updateValue')->name('updateValue');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });
});


Route::middleware('IsAdminLogin')->group(function () {
    // admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['controller' => CreatorController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getUser', 'getAllUsers')->name('getAllUsers');
        });
        Route::group(['controller' => AdminClientController::class], function () {
            Route::get('/customer', 'customer')->name('customer');
            Route::get('/customer/create', 'create')->name('customer.create');
            Route::post('/customer/create', 'storeCustomer')->name('customer.store');
        });
        Route::group(['controller' => AdminProjectController::class], function () {
            Route::get('/project/create', 'create')->name('project.create');
            Route::post('/project/create', 'store')->name('project.store');
            Route::get('/project/detail/{idProject}/{idCreator}', 'detail')->name('project.detail');
            Route::get('project/listCreator/{id}', 'listCreator')->name('project.listCreator');
            Route::get('project/{id}', 'getProject')->name('project.get');

            Route::get('project/assign/{id}', 'assign')->name('project.assign');
            Route::post('project/assign/{id}', 'assignCreator')->name('project.assign.create');
            Route::delete('project/destroy/{id}', 'destroy')->name('project.destroy');
        });
    });
});

  

Route::middleware('IsClientLogin')->group(function () {
    Route::group(['controller' => ClientController::class, 'as' => 'client.', 'prefix' => 'client'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/project/state/{id}', 'update')->name('state');
        Route::get('/project/detail/{idProject}/{idCreator}', 'detail')->name('project.detail');
        Route::get('/notifications/{id}','maskAsRead')->name('read');
    });
});


Route::get('/totaltime/{idUser}/{idProject}/{date}', [ClientController::class, 'getTotalTimeWithDate'])->name('getTotalTimeWithDate');