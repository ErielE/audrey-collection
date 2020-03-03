<?php

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

Route::get('/', 'Ecommerce\FrontController@index')->name('front.index');
Route::get('/produk', 'Ecommerce\FrontController@produk')->name('front.produk');
Route::get('/kategori/{slug}', 'Ecommerce\FrontController@kategoriProduk')->name('front.kategori');
Route::get('/produk/{slug}', 'Ecommerce\FrontController@show')->name('front.show_produk');
Route::post('/cart-add', 'Ecommerce\CartController@addToCart')->name('front.cart');
Route::get('/cart', 'Ecommerce\CartController@listCart')->name('front.list_cart');
Route::post('/cart/update', 'Ecommerce\CartController@updateCart')->name('front.update_cart');
Route::get('/checkout', 'Ecommerce\CartController@checkout')->name('front.checkout');
Route::post('/checkout', 'Ecommerce\CartController@processCheckout')->name('front.store_checkout');
Route::get('/checkout/{invoice}', 'Ecommerce\CartController@checkoutFinish')->name('front.finish_checkout');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('kategori', 'KategoriController')->except(['create', 'show']);
    Route::resource('produk', 'ProdukController')->except(['show']);
    Route::get('/produk/bulk', 'ProdukController@massUploadForm')->name('produk.bulk');
    Route::post('/produk/bulk', 'ProdukController@massUpload')->name('produk.saveBulk');

});

Route::group(['prefix' => 'member', 'namespace' => 'Ecommerce'], function() {
    Route::get('login', 'LoginController@loginForm')->name('customer.login');
    Route::post('login', 'LoginController@login')->name('customer.post_login');
    Route::get('verify/{token}', 'FrontController@verifyCustomerRegistration')->name('customer.verify');
    Route::group(['middleware' => 'customer'], function() {
        Route::get('dashboard', 'LoginController@dashboard')->name('customer.dashboard');
        Route::get('logout', 'LoginController@logout')->name('customer.logout');
        Route::get('orders', 'OrderController@index')->name('customer.orders');
        Route::get('orders/{invoice}', 'OrderController@view')->name('customer.view_order');
        Route::get('orders/pdf/{invoice}', 'OrderController@pdf')->name('customer.order_pdf');
        Route::get('payment', 'OrderController@paymentForm')->name('customer.paymentForm');
        Route::post('payment', 'OrderController@storePayment')->name('customer.savePayment');
        Route::get('setting', 'FrontController@customerSettingForm')->name('customer.settingForm');
        Route::post('setting', 'FrontController@customerUpdateProfile')->name('customer.setting');
    });
});



