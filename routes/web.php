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

Route::get('/', 'TelegramController@getHome');
Route::get('get-updates',   'TelegramController@getUpdates');
Route::get('getMe',   'TelegramController@getMe');
Route::get('send',  'TelegramController@getSendMessage');
Route::post('send', 'TelegramController@postSendMessage');

Route::post('newMessage', 'TelegramController@newMessage');


Route::get('enviarNotificacionPushAdministrador', 'TelegramController@enviarNotificacionPushAdministrador');
