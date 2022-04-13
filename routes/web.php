<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PGOfficeController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\PGOffice;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('admin')
    ->name('admin');

Route::get('/student', [StudentController::class, 'index'])
    ->middleware('student')
    ->name('student');

Route::get('/lecturer', [LecturerController::class, 'index'])
    ->middleware('lecturer')
    ->name('lecturer');

Route::get('/panel', [PanelController::class, 'index'])
    ->middleware('panel')
    ->name('panel');

Route::get('/PGOffice', [PGOfficeController::class, 'index'])
    ->middleware('pgoffice')
    ->name('pgoffice');


require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
