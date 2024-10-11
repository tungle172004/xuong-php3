<?php

use App\Http\Controllers\Transaction;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    $transaction = Session::get('transaction');
    if ($transaction && $transaction['status'] === 'complete') {
        Session::forget('transaction');
    }

    if ($transaction) {
        return redirect()->route('confirm')
            ->with('info', 'Bạn có phiên giao dịch chưa hoàn thành, bạn có muốn tiếp tục?');
    }

    return view('welcome');
});
Route::get('/start',[Transaction::class,'startForm'])->name('startForm');
Route::post('startTransaction', [Transaction::class,'startTransaction'])->name('startTransaction');
Route::get('confirm', [Transaction::class,'confirm'])->name('confirm');
Route::post('complete', [Transaction::class,'complete'])->name('complete');
Route::post('cancel',  [Transaction::class,'cancel'])->name('cancel'); 