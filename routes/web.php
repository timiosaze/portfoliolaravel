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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('notes', 'NotesController', ['name' => 'Note App'])->middleware('auth');
Route::resource('contacts', 'ContactsController', ['name' => 'Contact App'])->middleware('auth');
Route::resource('meetings', 'MeetingsController', ['name' => 'Meeting App'])->middleware('auth');
