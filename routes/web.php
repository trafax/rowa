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

Route::get('/', 'PageController@homepage');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', 'PageController@index');
    Route::resource('page', 'PageController');
    Route::post('page/search', 'PageController@index')->name('page.search');
    Route::post('page/delete', 'PageController@delete_selected')->name('page.delete_selected');
    Route::post('page/sort', 'PageController@sort')->name('page.sort');

    Route::post('asset/upload', 'AssetController@upload')->name('asset.upload');
    Route::post('asset/upload_onthefly', 'AssetController@upload_onthefly')->name('asset.upload_onthefly');
    Route::get('asset/{asset}/delete', 'AssetController@delete')->name('asset.delete');
    Route::post('asset/sort', 'AssetController@sort')->name('asset.sort');
    Route::post('asset/single_dropzone', 'AssetController@single_dropzone')->name('asset.single_dropzone');
    Route::post('asset/edit/{asset}', 'AssetController@edit')->name('asset.edit');
    Route::put('asset/{asset}/update', 'AssetController@update')->name('asset.update');

    Route::resource('webshopCategory', 'WebshopCategoryController');
    Route::post('webshopCategory/delete', 'WebshopCategoryController@delete_selected')->name('webshopCategory.delete_selected');
    Route::post('webshopCategory/sort', 'WebshopCategoryController@sort')->name('webshopCategory.sort');

    Route::resource('webshopProduct', 'webshopProductController');
    Route::post('webshopProduct/delete', 'webshopProductController@delete_selected')->name('webshopProduct.delete_selected');
    Route::post('webshopProduct/sort', 'webshopProductController@sort')->name('webshopProduct.sort');

    Route::resource('webshopFilter', 'webshopFilterController');
    Route::post('webshopFilter/delete', 'webshopFilterController@delete_selected')->name('webshopFilter.delete_selected');
    Route::post('webshopFilter/sort', 'webshopFilterController@sort')->name('webshopFilter.sort');

    Route::get('webshopOrder', 'webshopOrderController@index')->name('webshopOrder.index');
    Route::post('webshopOrder/delete', 'webshopOrderController@delete_selected')->name('webshopOrder.delete_selected');
    Route::get('webshopOrder/{webshopOrder}/show', 'webshopOrderController@show')->name('webshopOrder.show');
    Route::get('webshopOrder/{webshopOrder}/pdf', 'webshopOrderController@download_pdf')->name('webshopOrder.download_pdf');

    Route::resource('emailTemplates', 'EmailTemplateController');
    Route::post('emailTemplates/delete', 'EmailTemplateController@delete_selected')->name('emailTemplates.delete_selected');

    Route::resource('user', 'UserController');
    Route::post('user/search', 'UserController@index')->name('user.search');
    Route::post('user/delete', 'UserController@delete_selected')->name('user.delete_selected');
});

Route::get('logout', 'Auth\LoginController@logout');
Route::get('/admin', '\App\Http\Controllers\Auth\LoginController@showLoginForm');

Route::any('{slug?}', 'PageController@index')->name('page')->where('slug', '[a-z-]{3,}');
Route::any('webshop/category/{slug?}/{any?}', 'WebshopCategoryController@index')->name('webshopCategory')->where('any', '.*');
Route::any('webshop/product/{slug?}', 'WebshopProductController@index')->name('webshopProduct');
Route::post('webshop/set_filter/{slug}', 'WebshopCategoryController@set_filter')->name('webshop_set_filter');
Route::get('webshop/cart', 'WebshopCartController@index')->name('webshopCart.index');
Route::post('webshop/cart/update', 'WebshopCartController@update')->name('webshopCart.update');
Route::get('webshop/cart/truncate', 'WebshopCartController@truncate')->name('webshopCart.truncate');
Route::post('webshop/cart/add/{webshopProduct}', 'WebshopCartController@add')->name('webshopCart.add');

Route::get('webshop/checkout', 'CheckoutController@index')->name('checkout');

Route::get('webuser/profile', 'UserController@profile')->name('user.profile')->middleware('auth');
Route::put('webuser/update', 'UserController@update')->name('user.update')->middleware('auth');
Route::get('webusers/orders', 'UserController@orders')->name('user.orders')->middleware('auth');
Route::get('webusers/order/{webshopOrder}', 'UserController@order_view')->name('user.order.view')->middleware('auth');

Route::post('order/create', 'OrderController@create')->name('order.create');
Route::get('order/checkout', 'CheckoutController@doPayment')->name('doPayment');
Route::get('order/{order_id}/return', 'CheckoutController@paymentDone')->name('paymentDone');
Route::get('order/{order_id}/done', 'OrderController@done')->name('order.done');
Route::post('checkout/webhook', 'CheckoutController@webhook')->name('checkout.webhook');
