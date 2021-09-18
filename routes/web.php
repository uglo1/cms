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

// 一覧
Route::get('/list', 'CompanyController@list')->name('list');

// 検索用
Route::get('/search/{name}', 'CompanyController@search');

// 登録
Route::get('/register', 'CompanyController@register')->name('register');
Route::post('/store', 'CompanyController@store')->name('store');

// 削除
Route::delete('/delete/{id}', 'CompanyController@delete')->name('delete');

// 修正
Route::get('/modify/{id}', 'CompanyController@modify')->name('modify');
Route::post('/update/{id}', 'CompanyController@update')->name('update');



