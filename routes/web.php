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
});

Route::get('/admin', '\App\Http\Controllers\Auth\LoginController@showLoginForm');

Route::any('{slug?}', 'PageController@index')->name('page')->where('slug', '[a-z-]{3,}');
Route::any('webshop/category/{slug?}', 'WebshopCategoryController@index')->name('webshopCategory');
Route::any('webshop/product/{slug?}', 'WebshopProductController@index')->name('webshopProduct');
