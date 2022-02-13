<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\titikController;
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
    return view('index');
})->name('home');
Route::get('/titik/gedung', [titikController::class, 'titik_gedung']);
Route::get('/info/gedung/{id}', [titikController::class, 'info_gedung']);
Route::get('/search/gedung/{id}', [titikController::class, 'info_gedung']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::get('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
