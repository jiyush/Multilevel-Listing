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



Auth::routes();

Route::get('/home', 'categoryController@index')->name('home');
Route::get('/add','categoryController@addCategory');
Route::post('/insert','categoryController@insertCategory');
Route::get('/edit/{id}','categoryController@editCategory');
Route::post('/update','categoryController@updateCategory');
Route::post('/delete','categoryController@deleteCategory');
Route::get('/tree','categoryController@showTree');
Route::get('/getTree','categoryController@getTree');

Route::get('/test',function(){
	return  App\Category::with('childs')->where('parentId',0)->get();
});