<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

//1- Memanggil fungsi tampilan
Route::get('/', function () {
    return view('welcome');
});

route::get('/',[HomeController::class,'index']);

Route::middleware(['auth:sanctum','verified'])->get('/dashboard',function(){
        return view('dashboard');
    })->name('dashboard');

    route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth','verified');

    route::get('/view_category',[AdminController::class,'view_category']);

    route::post('/add_category',[AdminController::class,'add_category']);

    route::get('/delete_category/{id}',[AdminController::class,'delete_category']);

    route::get('/view_product',[AdminController::class,'view_product']);

    route::post('/add_product',[AdminController::class,'add_product']);

    route::get('/show_product',[AdminController::class,'show_product']);

    route::get('/delete_product/{id}',[AdminController::class,'delete_product']);

    route::get('/update_product/{id}',[AdminController::class,'update_product']);

    route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);

    route::get('/order_adm',[AdminController::class,'order_adm']);

    route::get('/bayar/{id}',[AdminController::class,'bayar']);

    route::get('/proses/{id}',[AdminController::class,'proses']);

    route::get('/selesai/{id}',[AdminController::class,'selesai']);

    route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);

    route::get('/send_email/{id}',[AdminController::class,'send_email']);

    route::get('/detail_order_adm/{id}',[AdminController::class,'detail_order_adm']);

    route::post('/send_user_email/{id}',[AdminController::class,'send_user_email']);

    route::get('/search',[AdminController::class,'searchdata']);









    route::get('/product_details/{id}',[HomeController::class,'product_details']);

    route::post('/add_cart/{id}',[HomeController::class,'add_cart']);

    route::get('/show_cart',[HomeController::class,'show_cart']);

    route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);

    route::get('/cash_order',[HomeController::class,'cash_order']);

    // route::get('/show_order',[HomeController::class,'show_order']);

    route::get('/cancel_order/{id}',[HomeController::class,'cancel_order']);

    route::get('/product_search',[HomeController::class,'product_search']);

    route::get('/products',[HomeController::class,'product']);

    route::get('/search_product',[HomeController::class,'search_product']);

    route::get('/contact',[HomeController::class,'contact']);

    route::get('/laporan',[HomeController::class,'laporan']);

    route::get('/payment/{id}',[HomeController::class,'payment']);
    //
    route::get('/payment_post/{id}',[HomeController::class,'payment_post']);

    // route::get('/order/create',[HomeController::class,'do_create_order']);

    // route::get('/test',[HomeController::class,'get_province']);

    route::post('/ongkir',[HomeController::class,'check_ongkir']);

    route::get('/kota/{id}',[HomeController::class,'get_city']);

    route::get('/origin={city_origin}&destination={city_destination}&weight={weight}&courier={courier}',[HomeController::class,'get_ongkir']);

    route::post('/checkout',[HomeController::class,'checkout']);

    route::get('/order',[HomeController::class,'order']);

    route::get('/detail_order/{id}',[HomeController::class,'detail_order']);
