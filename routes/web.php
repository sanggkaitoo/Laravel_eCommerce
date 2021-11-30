<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\NhomsanphamController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\UserManagementController;
use App\Http\Middleware\CheckAdminLogin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('UI.index');
})->name('UI.index');

Route::get('/shop', function () {
    return view('UI.shop');
})->name('UI.shop');

Route::get('/about', function() {
    return view('UI.about');
})->name('UI.about');

Route::get('/contact', function() {
    return view('UI.contact');
})->name('UI.contact');

Route::get('/test', function() {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/login', [App\Http\Controllers\AdminLoginController::class,'getlogin'])->name('admin.getlogin');
Route::post('/admin/login', [App\Http\Controllers\AdminLoginController::class,'postlogin'])->name('admin.postlogin');
Route::get('/admin/logout', [App\Http\Controllers\AdminLoginController::class,'getlogout'])->name('admin.getlogout');


Route::prefix('admin')->name('admin.')->middleware([CheckAdminLogin::Class])->group(function(){
    Route::get('/', [App\Http\Controllers\AdminLoginController::class, 'dashboard'])->name('dashboard');

    Route::get('/file', function () {
        return view('admin.file');
    })->name('file');

    Route::resources([
        'nhomsanpham' => App\Http\Controllers\NhomsanphamController::class,
        'sanpham' => App\Http\Controllers\SanphamController::class,
        'usermanagement' => App\Http\Controllers\UserManagementController::class,
    ]);

});
