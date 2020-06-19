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

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', 'PageController@index');
    Route::resource('page', 'PageController');
    Route::post('page/search', 'PageController@index')->name('page.search');
    Route::post('page/delete', 'PageController@delete_selected')->name('page.delete_selected');
    Route::post('page/sort', 'PageController@sort')->name('page.sort');

    Route::post('text/store', 'TextController@store');

    Route::get('block/create', 'BlockController@create');
    Route::post('block/store', 'BlockController@store');
    Route::get('block/{block}/edit', 'BlockController@edit');
    Route::put('block/{block}/update', 'BlockController@update');
    Route::post('block/sort', 'BlockController@sort');
    Route::delete('block/delete', 'BlockController@delete');

    Route::post('asset/upload', 'AssetController@upload')->name('asset.upload');
    Route::post('asset/upload_onthefly', 'AssetController@upload_onthefly')->name('asset.upload_onthefly');
    Route::get('asset/{asset}/delete', 'AssetController@delete')->name('asset.delete');
    Route::post('asset/sort', 'AssetController@sort')->name('asset.sort');
    Route::post('asset/single_dropzone', 'AssetController@single_dropzone')->name('asset.single_dropzone');
    Route::post('asset/edit/{asset}', 'AssetController@edit')->name('asset.edit');
    Route::put('asset/{asset}/update', 'AssetController@update')->name('asset.update');
    Route::post('asset/upload_tinymce', 'AssetController@upload_tinymce')->name('asset.upload_tinymce');

    Route::resource('webshopCategory', 'WebshopCategoryController');
    Route::post('webshopCategory/delete', 'WebshopCategoryController@delete_selected')->name('webshopCategory.delete_selected');
    Route::post('webshopCategory/sort', 'WebshopCategoryController@sort')->name('webshopCategory.sort');

    Route::resource('webshopProduct', 'WebshopProductController');
    Route::post('webshopProduct/delete', 'WebshopProductController@delete_selected')->name('webshopProduct.delete_selected');
    Route::post('webshopProduct/sort', 'WebshopProductController@sort')->name('webshopProduct.sort');

    Route::resource('webshopFilter', 'WebshopFilterController');
    Route::post('webshopFilter/delete', 'WebshopFilterController@delete_selected')->name('webshopFilter.delete_selected');
    Route::post('webshopFilter/sort', 'WebshopFilterController@sort')->name('webshopFilter.sort');

    Route::get('webshopOrder', 'WebshopOrderController@index')->name('webshopOrder.index');
    Route::post('webshopOrder/delete', 'WebshopOrderController@delete_selected')->name('webshopOrder.delete_selected');
    Route::get('webshopOrder/{webshopOrder}/show', 'WebshopOrderController@show')->name('webshopOrder.show');
    Route::get('webshopOrder/{webshopOrder}/pdf', 'WebshopOrderController@download_pdf')->name('webshopOrder.download_pdf');

    Route::resource('emailTemplates', 'EmailTemplateController');
    Route::post('emailTemplates/delete', 'EmailTemplateController@delete_selected')->name('emailTemplates.delete_selected');

    Route::resource('user', 'UserController');
    Route::post('user/search', 'UserController@index')->name('user.search');
    Route::post('user/delete', 'UserController@delete_selected')->name('user.delete_selected');

    Route::resource('form', 'FormController');
    Route::get('form/{form}/destroy', 'FormController@destroy')->name('form.destroy');
    Route::get('form/{block}/block_edit', 'FormController@block_edit')->name('form.block.edit');
    Route::put('form/{block}/block_update', 'FormController@block_update')->name('form.block.update');
    Route::get('form/subscription/{formSubscription}/show', 'FormController@show_subscription')->name('form.subscription.show');

    Route::resource('form_field', 'FormFieldController');
    Route::get('form_field/{form_field}/destroy', 'FormFieldController@destroy')->name('form_field.destroy');
    Route::post('form_field/sort', 'FormFieldController@sort')->name('form_field.sort');

    Route::resource('form_value', 'FormValueController');
    Route::get('form_value/{form_value}/destroy', 'FormValueController@destroy')->name('form_value.destroy');
    Route::post('form_value/sort', 'FormValueController@sort')->name('form_value.sort');

    Route::resource('project', 'ProjectController');
    Route::resource('referentie', 'ReferentieController');
});

Route::get('logout', 'Auth\LoginController@logout');
Route::get('/admin', '\App\Http\Controllers\Auth\LoginController@showLoginForm');

Route::match(['post','get'], 'search', 'SearchController@index')->name('search');

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
Route::get('webuser/stock', 'StockController@index')->name('user.stock')->middleware('auth');
Route::post('webuser/stock/order', 'StockController@order')->name('user.stock.order')->middleware('auth');
Route::get('webuser/stock/done', 'StockController@done')->name('user.stock.done')->middleware('auth');
Route::get('webuser/products', 'UserController@products')->name('user.products')->middleware('auth');

Route::post('order/create', 'OrderController@create')->name('order.create');
Route::get('order/checkout', 'CheckoutController@doPayment')->name('doPayment');
Route::get('order/{order_id}/return', 'CheckoutController@paymentDone')->name('paymentDone');
Route::get('order/{order_id}/done', 'OrderController@done')->name('order.done');
Route::post('checkout/webhook', 'CheckoutController@webhook')->name('checkout.webhook');
Route::get('checkout/oprekening_done', 'CheckoutController@oprekeningDone')->name('checkout.oprekening_done');

Route::post('form/send/{form}', 'FormController@send')->name('form.send');
Route::get('form/getForms', 'FormController@getForms');

Route::post('mailchimp/subscribe', 'MailchimpController@subscribe')->name('mailchimp.subscribe');
