<?php

use App\Http\Middleware\checkAdmin;
use App\Http\Middleware\checkShipper;
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

Route::get('/',"home\homeController@index");

Route::get('/product','home\productController@index');
Route::post('/product','home\productController@search');
Route::get('/product/{slug}','home\productController@detail');
// Route::post('/product/sort','home\productController@sort');
Route::post('/product/{text}','home\productController@searchText');
Route::post('/product/{id}/order','home\productController@order');
Route::get('/orderList', 'home\orderListController@index');

Route::get('/login',"auth\loginController@index");
Route::get('/logout',"auth\loginController@logout");
Route::post('/login/post','auth\loginController@login');
Route::get('/register','auth\registerController@index');
Route::post('/register/post','auth\registerController@register');

Route::get('admin/dashboard','admin\dashboardController@index')->middleware(checkAdmin::class);
Route::get('admin/order','admin\orderController@index')->middleware(checkAdmin::class);;
Route::get('admin/user', 'admin\userController@index')->middleware(checkAdmin::class);;
Route::get('admin/product',"admin\productController@index")->middleware(checkAdmin::class);;
Route::get('admin/product/add',"admin\productController@viewAddProduct")->middleware(checkAdmin::class);;
Route::post('admin/product/add',"admin\productController@insert")->middleware(checkAdmin::class);;
Route::post('admin/product/add/getSlug',"admin\productController@slugSuggesstion")->middleware(checkAdmin::class);;
Route::get('admin/product/edit/{id}', "admin\productController@edit")->middleware(checkAdmin::class);;
Route::get('admin/product/{id}/delete',"admin\productController@remove")->middleware(checkAdmin::class);;
Route::post('admin/product/edit/update',"admin\productController@update")->middleware(checkAdmin::class);;
Route::get('admin/promote',"admin\promotionController@index")->middleware(checkAdmin::class);;
Route::get('admin/promote/add',"admin\promotionController@viewAddPromotion")->middleware(checkAdmin::class);;
Route::post('admin/promote/add',"admin\promotionController@addPromotion")->middleware(checkAdmin::class);;
Route::get('/admin/promote/edit/{id}', "admin\promotionController@edit")->middleware(checkAdmin::class);;
Route::post('/admin/promote/edit/update',"admin\promotionController@update")->middleware(checkAdmin::class);;
Route::get('/admin/promote/edit/{id}/delete', "admin\promotionController@delete")->middleware(checkAdmin::class);;

Route::get('/shipper/dashboard',"admin\shiperController@index")->middleware(checkShipper::class);
Route::get('/shipper/shipping',"admin\shiperController@shippingList")->middleware(checkShipper::class);
Route::get('/shipper/order/shiping/{id}',"admin\shiperController@shipping")->middleware(checkShipper::class);
Route::get('/shipper/shipped',"admin\shiperController@shippedList")->middleware(checkShipper::class);
Route::get('/shipper/order/shipped/{id}',"admin\shiperController@shipped")->middleware(checkShipper::class);

Route::get('/add-to-cart/{id}',"home\homeController@addToCart");
Route::get('/cart',"home\cartController@index");
Route::get("/cart/decr/{id}","home\cartController@decrCart");
Route::get("/cart/incr/{id}","home\cartController@incrCart");
Route::get("/cart/delete/{id}","home\cartController@deleteItem");
Route::post('/cart',"home\cartController@checkPromotion");
Route::post('/comment', "home\productController@comment");
Route::post('/rating', "home\productController@rate");
Route::get('/profile', "home\profileController@index");
Route::post('/profile/balance/add',"home\profileController@addMoney");
Route::post('/order',"home\cartController@order");
Route::get('/403', function(){
    return view('errors.403');
})->name('403');

Route::get("/clearSession","home\cartController@clearSession");

Route::get('/test','auth\loginController@test');


Route::get('admin/test','admin\productController@testDeleteFile');

Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];

    \Mail::to('thao.nguyen21@student.passerellesnumeriques.org')->send(new \App\Mail\MyTestMail($details));

    dd("Email is Sent.");
});
