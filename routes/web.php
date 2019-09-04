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

Route::get('/phoneBook/{name}',function(){
    return redirect('/');
})->where('name','[A-Za-z]+');


Route::resource('phoneBook','PhoneBookController');
Route::post('/getData','PhoneBookController@getData');
