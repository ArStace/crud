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

Auth::routes(['register' => false]);

Route::get('', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'book'], function(){
    Route::get('', 'BookController@index')->name('book.index');
    Route::get('create', 'BookController@create')->name('book.create');
    
    Route::post('store', 'BookController@store')->name('book.store');
    Route::get('edit/{book}', 'BookController@edit')->name('book.edit');
    Route::post('update/{book}', 'BookController@update')->name('book.update');
    Route::post('destroy/{book}', 'BookController@destroy')->name('book.destroy');

    Route::get('show', 'BookController@show')->name('book.show');
    Route::get('show/{order}', 'BookController@show')->name('book.show_order');
    Route::get('sort', 'BookController@sort')->name('book.sort');
    
});



Route::group(['prefix' => 'author'], function(){
    Route::get('', 'AuthorController@index')->name('author.index');
    Route::get('create', 'AuthorController@create')->name('author.create');
    
    Route::post('store', 'AuthorController@store')->name('author.store');
    Route::get('edit/{author}', 'AuthorController@edit')->name('author.edit');
    Route::post('update/{author}', 'AuthorController@update')->name('author.update');
    Route::post('destroy/{author}', 'AuthorController@destroy')->name('author.destroy');

    Route::get('show', 'AuthorController@show')->name('author.show');
    Route::get('show/{order}', 'AuthorController@show')->name('author.show_order');

    Route::get('books/{author}', 'AuthorController@books')->name('author.books');
});
