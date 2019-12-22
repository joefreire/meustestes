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

Route::get('/form', function () {
	return view('form.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::prefix('mensagens')->group(function () {
	Route::get('/', 'MensagemController@getData')->name('mensagem.index');
	Route::get('/novo', 'MensagemController@create')->name('mensagem.create');
	Route::get('/{id}/destroy', 'MensagemController@destroy')->name('mensagem.destroy');
	Route::post('/store', 'MensagemController@store')->name('mensagem.store');
	Route::get('/getData', 'MensagemController@getData')->name('mensagem.data');
});
