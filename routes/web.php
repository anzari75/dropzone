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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('states', 'StateController');
Route::resource('areas', 'AreasController');
Route::resource('categories', 'CategoryController');
Route::resource('subcategories', 'SubCategoryController');
Route::resource('brands', 'BrandController');
Route::resource('listingtypes', 'ListingtypeController');
Route::get('products/areas/{state_id}', 'ProductsController@getStateAreas');
Route::get('products/subcategories/{category_id}', 'ProductsController@getSubcategory');
Route::resource('products', 'ProductsController');

