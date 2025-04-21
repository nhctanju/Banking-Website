<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CardOfferController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ScheduledTransferController;
use App\Http\Controllers\SharedWalletController;
use App\Http\Controllers\AtmController;
use App\Http\Controllers\WithdrawController;


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

// Authenticated routes group
Route::middleware('auth')->group(function () {
    // Home route
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Dashboard route
    Route::get('/dashboard', [LoanRequestController::class, 'index'])->name('dashboard');
    
    // Wallet routes
    Route::prefix('wallet')->group(function () {
        Route::get('/create', [WalletController::class, 'showCreateForm'])->name('wallet.create.form');
        Route::post('/create', [WalletController::class, 'createWallet'])->name('wallet.create');
    });
    
    // Card offers routes
    Route::get('/card-offers', [CardOfferController::class, 'index'])->name('card_offers');
    
    // Transfer routes
    Route::get('/transfer', [TransactionController::class, 'showTransferForm'])->name('transactions.transfer');
    Route::post('/transfer', [TransactionController::class, 'transfer'])->name('transactions.transfer.submit');
    
    // Other transaction routes
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{id}/receipt', [TransactionController::class, 'generateReceipt'])->name('transactions.receipt');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    
    // Notifications route
    Route::patch('/notifications/{id}/mark-as-read', function ($id) {
        $notification = Auth::user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }
        return back();
    })->name('notifications.markAsRead');
    
    // Loan requests routes
    Route::get('/loan-requests/create', [LoanRequestController::class, 'create'])->name('loan_requests.create');
    Route::get('/loan-requests', [LoanRequestController::class, 'index'])->name('loan_requests.index');
    Route::post('/loan-requests', [LoanRequestController::class, 'store'])->name('loan_requests.store');
    Route::patch('/loan-requests/{id}/approve', [LoanRequestController::class, 'approve'])->name('loan_requests.approve');
    Route::patch('/loan-requests/{id}/decline', [LoanRequestController::class, 'decline'])->name('loan_requests.decline');
    Route::get('/loan-requests/{id}', [LoanRequestController::class, 'show'])->name('loan_requests.show');
    
    // Scheduled transfers routes
    Route::resource('scheduled_transfers', ScheduledTransferController::class)->except(['show']);
}); // <-- Properly close the middleware group here

// Time-check route (outside the auth middleware group)
Route::get('/time-check', function() {
    return [
        'APP_TIMEZONE' => config('app.timezone'),
        'PHP Time' => now()->toDateTimeString(),
        'DB Time' => \DB::select('SELECT NOW() as now')[0]->now,
        'Server Time' => shell_exec('date'),
        'Scheduled Transfers Pending' => \App\Models\ScheduledTransfer::where('status', 'pending')
            ->where('scheduled_at', '<=', now())
            ->count()
    ];
});



Route::middleware(['auth'])->group(function () {
    Route::get('/shared-wallets', [SharedWalletController::class, 'index'])->name('shared_wallets.index');
    Route::get('/shared-wallets/create', [SharedWalletController::class, 'create'])->name('shared_wallets.create');
    Route::post('/shared-wallets', [SharedWalletController::class, 'store'])->name('shared_wallets.store');
    Route::get('/shared-wallets/{sharedWallet}', [SharedWalletController::class, 'show'])->name('shared_wallets.show');
    // Add inside auth middleware group
    Route::get('/nearby-atms', [AtmController::class, 'index'])->name('atms.nearby');
    Route::get('/withdraw', [WithdrawController::class, 'showForm'])->name('withdraw');
    Route::post('/withdraw', [WithdrawController::class, 'process'])->name('withdraw.submit');
    // Add inside auth middleware group
    Route::get('/withdraw', [WithdrawController::class, 'showForm'])->name('withdraw');
    Route::post('/withdraw', [WithdrawController::class, 'process'])->name('withdraw.submit');
});
