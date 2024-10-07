<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\select;

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
    return view('welcome');
});
// bài 1 
Route::get('/joinNhieu',function () {
    $query = DB::table('users as u')
    ->select('u.name', DB::raw("sum(o.amount) as total_spent"))
    ->join('orders as o', 'u.id','=','o.user_id')
    ->groupBy('u.name')
    ->having('total_spent','>',1000);

    $all =$query->get();
    dd($all);
});

// bài 2

Route::get('/thongkeTime', function ()  {
    $query = DB::table('orders as o')
    ->select('o.order_date as date', DB::raw("count(*) as order_count"), DB::raw("Sum(total_amount) as total_sales"))
    ->whereBetween('o.order_date',['2000-01-01','2024-09-30'])
    ->GroupBy('date');

    $all =$query->get();
    dd($all);
});

// bài 3 
Route::get('/truyVanTapKetQuaKhongCo', function ()  {
    $query = DB::table('products as p')
    ->select('product_name')
    ->whereNotExists(
        DB::table('order__items as o')
        ->select('o.id')
        ->where('o.product_id','=','p.id')
    );
    $all =$query->get();
    dd($all);
});

// bài 4  

Route::get('/san-pham-ban-chay', action: function () {
    $products = DB::table('sales')
        ->select('product_id', DB::raw('SUM(quantity) AS total_sold'))
        ->groupBy('product_id')
        ->having('total_sold', '>', 100)
        ->pluck('product_id');

    $result = DB::table('products')
        ->whereIn('id', $products)
        ->select('product_name', 'id');

    $all = $result->get();

    dd( $all);
});

// baif 5
Route::get('/daMua30NgayQua', function () {
    $query = DB::table('users as u')
    ->select('u.name','p.product_name','o.order_date')
    ->join('orders as o','u.id', '=','o.user_id')
    ->join('order__items as oi', 'o.id','=','oi.order_id')
    ->join('products as p','p.id','=','oi.product_id')
    ->where('o.order_date','>=',DB::raw("NOW() - INTERVAL 30 DAY"));
    $all =$query->get();
    dd($all);
});

// bài 6 
Route::get('tongDoanhThuThang', function () {
    $query  = DB::table('orders as a')
    ->select(DB::raw("date_format(a.order_date,'%Y-%m') "), DB::raw("SUM(b.quantity *  b.price)"))
    ->join('order__items as b' , 'b.order_id', '=','a.id')
    
    ->groupBy(DB::raw("date_format(a.order_date,'%Y-%m') "))
    ->orderBy(DB::raw("date_format(a.order_date,'%Y-%m') "), 'DESC');

    $all = $query->get();
    dd($all);
});

// Bài 7

Route::get('/chuaduocBan', function () {
    $query = DB::table('products')
        ->select('products.product_name')
        ->leftJoin('order__items','products.id' , '=','order__items.product_id')
        ->whereNull('order__items.product_id' );

        $all = $query->get();
        dd($all);
});

// bài 8
Route::get('sanPhamDoanhThuCaoNhat', function () {
    $subQuery = DB::table('order__items')
        ->select('product_id', DB::raw('SUM(quantity * price) as total'))
        ->groupBy('product_id');

    $query = DB::table('products as p')
        ->joinSub($subQuery, 'oi', function ($join) {
            $join->on('p.id', '=', 'oi.product_id');
        })
        ->select('p.id', 'p.product_name', DB::raw('MAX(oi.total) AS max_revenue'))
        ->groupBy('p.id', 'p.product_name')
        ->orderBy('max_revenue', 'DESC');
    
    $all = $query->get();
    dd($all);
});

// bài 9 
Route::get('donHangTrenTrungBinh', function () {
    
    $subQuery = DB::table('order__items')
        ->select(DB::raw('SUM(quantity * price) as total'))
        ->groupBy('order_id');

    
    $averageOrderValue = DB::table(DB::raw("({$subQuery->toSql()}) as avg_order_value"))
        ->select(DB::raw('AVG(total)'))->value('AVG(total)');

    
    $query = DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('order__items', 'orders.id', '=', 'order__items.order_id')
        ->select('orders.id', 'users.name', 'orders.order_date', DB::raw('SUM(order__items.quantity * order__items.price) as total_value'))
        ->groupBy('orders.id', 'users.name', 'orders.order_date')
        ->having(DB::raw('SUM(order__items.quantity * order__items.price)'), '>', $averageOrderValue)
        ->get();

    dd($query);
});

// bài 10  em làm chưa được

// Route::get('donHangTrenTrungBinh', function () {
    
//     $query = DB::table('products as p')
//     ->select('p.category_id','p.product_name',DB::raw("sum(oi.quantity) as total_sold"))
//     ->join('order__items as oi','p.id' ,'=','oi.product_id')
//     ->having('total_sold', '>', function ($subquery) {
//         $subquery->select(DB::raw('MAX(sub.total_sold)'))
//         ->from(function($query) {
//             $query->select('oi.product_id', DB::raw("SUM(oi.quantity) as total_sold"))
//                 ->from('order__items as oi')
//                 ->join('products as p', 'p.id', '=', 'oi.product_id')
//                 ->groupBy('oi.product_id');
//         }, 'sub')
       
//     });
// });



// 1. Eloquent ORM là gì trong Laravel?
// Eloquent ORM (Object-Relational Mapping) là một phần của Laravel giúp bạn tương tác với cơ sở dữ liệu bằng cách sử dụng các mô hình (models) trong PHP thay vì phải viết các truy vấn SQL trực tiếp. Eloquent cho phép bạn làm việc với các bảng trong cơ sở dữ liệu như là các đối tượng trong PHP, giúp mã nguồn trở nên dễ đọc và bảo trì hơn. Eloquent hỗ trợ nhiều tính năng, bao gồm:

// Quản lý các mối quan hệ giữa các bảng (như one-to-many, many-to-many).
// Cung cấp các phương thức để thực hiện các thao tác CRUD (Create, Read, Update, Delete) một cách dễ dàng.
// Ánh xạ các trường của bảng trong cơ sở dữ liệu thành các thuộc tính của đối tượng.
// 2. Các quy ước mặc định của Eloquent
// Khi ánh xạ giữa tên model và bảng trong cơ sở dữ liệu, Eloquent có các quy ước mặc định sau:

// Tên bảng: Tên bảng trong cơ sở dữ liệu sẽ là dạng số nhiều của tên model. Ví dụ, nếu bạn có một model tên là Post, bảng tương ứng trong cơ sở dữ liệu sẽ là posts.
// Khóa chính: Mặc định, Eloquent sử dụng trường id làm khóa chính cho các bảng.
// Thời gian: Nếu bạn sử dụng tính năng thời gian (timestamps), Eloquent sẽ tự động thêm hai trường created_at và updated_at vào bảng.