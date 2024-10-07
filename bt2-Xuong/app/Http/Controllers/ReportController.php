<?php

namespace App\Http\Controllers;

use App\Models\expense;
use App\Models\sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request) {
        $sales = sale::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->sum('total_amount'); // Tổng doanh thu

        $expenses = expense::whereMonth('created_at', date('m'))
                           ->whereYear('created_at', date('Y'))
                           ->sum('amount'); // Tổng chi phí
         // Tính lợi nhuận trước thuế
        $profitBeforeTax = $sales - $expenses;

        // Tính thuế (giả sử thuế suất là 10%)
        $tax = $profitBeforeTax * 0.1;
         // Lợi nhuận sau thuế
         $profitAfterTax = $profitBeforeTax - $tax;

         // Trả về kết quả báo cáo
         return view('index', compact('sales', 'expenses', 'profitBeforeTax', 'tax', 'profitAfterTax'));
    }
}
