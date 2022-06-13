<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PGOfficeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserSwitchController;
use App\Models\Interest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect()->route('redirects');
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


Route::post('/interest/new-interest', [Interest::class, 'create'])->name('create_interest');
Route::get('/interest/{interest_id}', [Interest::class, 'show'])->name('show_interest');
Route::post('/interest/{interest_id}', [Interest::class], 'update')->name('update_interest');
Route::delete('/interest/{interest_id}', [Interest::class], 'destroy')->name('destroy_interest');


Route::get('redirects', 'App\Http\Controllers\HomeController@index')->name('redirects');


// TEMPORARY REMOVE IN PRODUCTION
Route::get('switchuser', [UserSwitchController::class,'index'])->name('user.switch');
Route::post('switchuser', [UserSwitchController::class,'switchUser']);
Route::get('restoreuser', [UserSwitchController::class, 'restoreUser'])->name('user.restore');
// TEMPORARY REMOVE IN PRODUCTION


require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
