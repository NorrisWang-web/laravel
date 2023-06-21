<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm']);
Route::get('/register/admin', [App\Http\Controllers\Auth\RegisterController::class, 'showAdminRegisterForm']);

Route::post('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin']);
Route::post('/register/admin', [App\Http\Controllers\Auth\RegisterController::class, 'registerAdmin'])->name('admin-register');

Route::view('/admin', 'admin')->middleware('auth:admin')->name('admin-home');



Route::resource('admin/event', 'App\Http\Controllers\EventAdminController');
Route::post('admin/event/update', [App\Http\Controllers\EventAdminController::class, 'update'])->name('event.update');
Route::post('admin/event/destroy/{id}', [App\Http\Controllers\EventAdminController::class, 'destroy'])->name('event.destroy');

Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('password/admin/reset', [App\Http\Controllers\Auth\AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/admin/email', [App\Http\Controllers\Auth\AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/admin/reset/{token}', [App\Http\Controllers\Auth\AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('password/admin/reset', [App\Http\Controllers\Auth\AdminResetPasswordController::class, 'reset'])->name('admin.password.update');
  });
