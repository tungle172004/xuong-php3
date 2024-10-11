<?php

namespace App\Http\Controllers;

use App\Models\Transaction as ModelTramsaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Transaction extends Controller
{
    public function startForm() {
        $transaction = Session::get('transaction');
        if ($transaction && $transaction['status'] === 'complete') {
            Session::forget('transaction');
        }
    
        if ($transaction) {
            return redirect()->route('confirm')
                ->with('info', 'Bạn có phiên giao dịch chưa hoàn thành, bạn có muốn tiếp tục?');
        }
    
        return view('start');
    }
    public function startTransaction(Request $request) {
         $request->validate([
            'amount' => 'required|numeric|min:1',
            'receiver_account' => 'required|string'
        ]);

        // theem session 
        Session::put('transaction',[
            'amount' => $request->input('amount'),
            'receiver_account' => $request->input('receiver_account'),
            'status' => 'in_progress',
            'step' => 1 ,
        ]);
        return redirect()->route('confirm');

    }
    public function confirm() {
        $transaction = Session::get('transaction');
        // dd( $transaction);
        if(!$transaction){
            return redirect()->route('start')->with('error','Không Có phiên giao dịch nào! ');
        }
        Session::put('transaction.step',2);
        return view('confirm', compact('transaction'));
    }
    public function complete() {
        $transaction = Session::get('transaction');
        // dd($transaction);
        if(!$transaction){
            return redirect()->route('start')->with('error','Không Có phiên giao dịch nào! ');
        }
        $transaction['status'] = 'complete';
        // dd($transaction);
        ModelTramsaction::create($transaction);

        Session::forget('transaction');

        return view('complete');
    }
    public function cancel() {
        $transaction = Session::get('transaction');
        if(!$transaction){
            return redirect()->route('start')->with('error','Không Có phiên giao dịch nào! ');
        }
        Session::forget('transaction');

        return redirect()->route('startForm')->with('success','Phiên giao dịch đã bị hủy!');
    }
}
