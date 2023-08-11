<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Exports\UsersExport;

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


Route::get('/', [UserController::class, 'index'])->name('users.index');

Route::resource('users', UserController::class);


Route::get('/export-users', function () {
    return Excel::download(new UsersExport, 'users.xlsx');
})->name('export.users');