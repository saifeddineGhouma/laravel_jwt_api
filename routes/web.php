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
Route::get('/chat','ChatController@index');
Route::post('/chat/store','ChatController@store');
Route::get('/chat/ajax','ChatController@ajax');
Route::get('/pdf','ChatController@GeneratePdf');
Route::get('/createWordDocx','ChatController@createWordDocx');
Route::post('user/register','ApiRegisterController@register');
Route::post('user/login','ApiLoginController@login');
Route::get('/datatable',function(){
    return view('datatable');
});