<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PageController;

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
    return view('pages.home');
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_p'])->name('register_p');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_p'])->name('login_p');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/settings', [PageController::class, 'settings'])->name('settings')->middleware('auth');
Route::post('/settingsImage', [PageController::class, 'updateImage'])->name('updateImage')->middleware('auth');
Route::post('/settingsProfile', [PageController::class, 'updateProfile'])->name('updateProfile')->middleware('auth');

Route::get('/delete/{name}/{productId}', [ListController::class, 'deleteList'])->name('deleteList')->middleware('auth');

Route::post('/addlist', [ListController::class, 'createList'])->name('createList')->middleware('auth');

Route::get('/{name}', [PageController::class, 'pricelist'])->name('pricelist');

