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

//Route::get('/', function () {
//    return view('home');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
//Route::get('/', 'HomeController@test')->name('home');
Route::get('category/{category_slug}', 'ItemsController@showItemsByCategory')->name('showItemsByCategory');
Route::get('item_info/{slug}', 'ItemsController@itemInfo')->name('itemInfo');
Route::post('search', 'ItemsController@searchItems')->name('search');

//Cart
Route::get('cart/', 'CartController@index')->name('cart');

Route::get('cart/add/{id}', 'CartController@add')->name('addToCart');
Route::get('cart/inc/{id}', 'CartController@inc');
Route::get('cart/dec/{id}', 'CartController@dec');
Route::get('cart/remove/{id}', 'CartController@remove');

//Order
Route::get('order/create', 'OrderController@create')->name('newOrder');
Route::get('orders/show', 'OrderController@all')->name('orders');

Route::group(['prefix' => 'admin'], function () {

    // Admin Panel
    Route::get('/', 'AdminController@index')->name('admin');

    //Orders
    Route::get('orders/all', 'AdminController@index')->name('allOrders');

    //Users
    Route::get('users', 'AdminController@showAllUsers')->name('allUsers');

//Categories
    Route::get('categories', 'AdminController@showAllCategories')->name('categories');
//    Route::get('newCategory', 'AdminController@addCategoryForm')->name('addCategoryForm');
    Route::post('addCategory', 'AdminController@addCategory')->name('addCategory');
    Route::post('categoryRemove', 'AdminController@categoryRemove')->name('categoryRemove');
    Route::post('categoryUpdate', 'AdminController@categoryUpdate')->name('categoryUpdate');

    //Route::resource('categories', 'AdminCo')

//Items
    Route::get('items', 'AdminController@showAllItems')->name('items');
    Route::get('category/{slug}', 'AdminController@showItemsByCategory')->name('ItemsByCategory');
    Route::get('itemsAdd', 'AdminController@addItemsForm')->name('addItemsForm');
    Route::post('itemsNew', 'AdminController@addNewItem')->name('addNewItem');
    Route::get('itemRemove/{id}', 'AdminController@itemRemove')->name('itemRemove');
    Route::get('itemUpdate/{id}', 'AdminController@itemUpdate');
    Route::post('itemSave', 'AdminController@itemSave')->name('saveItem');
    Route::get('item/{id}', 'AdminController@itemInfo')->name('itemInfo');

});











