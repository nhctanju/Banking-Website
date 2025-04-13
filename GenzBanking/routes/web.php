<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WalletController;
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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dashboard', [DashboardController::class, 'dash'])
    ->middleware(['auth'])
    ->name('dashboard');



Route::middleware('auth')->group(function () {
        // Show wallet creation form
Route::get('/wallet/create', [WalletController::class, 'showCreateForm'])->name('wallet.create.form');
    
        // Handle form submission
Route::post('/wallet/create', [WalletController::class, 'createWallet'])->name('wallet.create');
    });
    