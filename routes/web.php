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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/deckbuilder', 'CardController@index');
Route::get('/editDeck', function () {
	return view('edit');
});

Route::get('/decks/{deck}', 'DeckController@show');

Route::get('/card', function () {
	return view('card');
});

Route::get('/about', function () {
	return view('about');
});