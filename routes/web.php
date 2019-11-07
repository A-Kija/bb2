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



Route::get('', 'FrontController@index')->name('index');
Route::get('pica/{product_group}', 'FrontController@group')->name('pizza');

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'authors'], function(){
    Route::get('', 'AuthorController@index')->name('author.index');
    Route::get('create', 'AuthorController@create')->name('author.create');
    Route::post('store', 'AuthorController@store')->name('author.store');
    Route::get('edit/{author}', 'AuthorController@edit')->name('author.edit');
    Route::post('update/{author}', 'AuthorController@update')->name('author.update');
    Route::post('delete/{author}', 'AuthorController@destroy')->name('author.destroy');
    Route::post('delete-photo/{author}', 'AuthorController@destroyPhoto')->name('author.destroy.photo');
    Route::get('show/{author}', 'AuthorController@show')->name('author.show');
    Route::get('pdf/{author}', 'AuthorController@pdf')->name('author.pdf');
});

Route::group(['prefix' => 'books'], function(){
    Route::get('', 'BookController@index')->name('book.index');
    Route::get('create', 'BookController@create')->name('book.create');
    Route::post('store', 'BookController@store')->name('book.store');
    Route::get('edit/{book}', 'BookController@edit')->name('book.edit');
    Route::post('update/{book}', 'BookController@update')->name('book.update');
    Route::post('/delete/{book}', 'BookController@destroy')->name('book.destroy');
    Route::get('show/{book}', 'BookController@show')->name('book.show');
 });



 Route::group(['prefix' => 'admin','middleware' => 'auth'], function(){

    Route::group(['prefix' => 'manufacture'], function(){
        Route::get('', 'ManufactureController@index')->name('manufacture.index');
        Route::get('create', 'ManufactureController@create')->name('manufacture.create');
        Route::post('store', 'ManufactureController@store')->name('manufacture.store');
        Route::get('edit/{manufacture}', 'ManufactureController@edit')->name('manufacture.edit');
        Route::post('update/{manufacture}', 'ManufactureController@update')->name('manufacture.update');
        Route::post('delete/{manufacture}', 'ManufactureController@destroy')->name('manufacture.destroy');
        Route::get('show/{manufacture}', 'ManufactureController@show')->name('manufacture.show');
    });

    Route::group(['prefix' => 'tag'], function(){
        Route::get('', 'TagController@index')->name('tag.index');
        Route::get('create', 'TagController@create')->name('tag.create');
        Route::post('store', 'TagController@store')->name('tag.store');
        Route::get('edit/{tag}', 'TagController@edit')->name('tag.edit');
        Route::post('update/{tag}', 'TagController@update')->name('tag.update');
        Route::post('delete/{tag}', 'TagController@destroy')->name('tag.destroy');
        Route::get('show/{tag}', 'TagController@show')->name('tag.show');
    });

    Route::group(['prefix' => 'product-group'], function(){
        Route::get('', 'ProductGroupController@index')->name('product_group.index');
        Route::get('create', 'ProductGroupController@create')->name('product_group.create');
        Route::post('store', 'ProductGroupController@store')->name('product_group.store');
        Route::get('edit/{product_group}', 'ProductGroupController@edit')->name('product_group.edit');
        Route::post('update/{product_group}', 'ProductGroupController@update')->name('product_group.update');
        Route::post('delete/{product_group}', 'ProductGroupController@destroy')->name('product_group.destroy');
        Route::get('show/{product_group}', 'ProductGroupController@show')->name('product_group.show');
    });

    Route::group(['prefix' => 'product'], function(){
        Route::get('', 'ProductController@index')->name('product.index');
        Route::get('create', 'ProductController@create')->name('product.create');
        Route::post('store', 'ProductController@store')->name('product.store');
        Route::get('edit/{product}', 'ProductController@edit')->name('product.edit');
        Route::post('update/{product}', 'ProductController@update')->name('product.update');
        Route::post('delete/{product}', 'ProductController@destroy')->name('product.destroy');
        Route::get('show/{product}', 'ProductController@show')->name('product.show');
    });

});
 
 
