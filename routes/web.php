<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/manager/{filter?}', 'ManagerController@index')->where('filter','(answered|closed|viewed)=[01]')->name('manager');
Route::get('/client', 'ClientController@index')->name('client');
Route::get('/error', 'ErrorController@index')->name('error');

Route::match(['get', 'post'], '/request/create', 'SupportRequestController@create')->name('request_create');
Route::match(['get', 'post'], '/request/update/{id}', 'SupportRequestController@update')->name('request_update');
Route::get("/request/{id}", 'SupportRequestController@view')->name('request_view');
Route::get("/request/close/{id}", 'SupportRequestController@close')->name('request_close');
Route::get("/request/delete/{id}", 'SupportRequestController@delete')->name('request_delete');

Route::match(['get', 'post'], '/answer/create/{support_request_id}', 'AnswerController@create')->name('answer_create');
Route::match(['get', 'post'], '/answer/update/{id}', 'AnswerController@update')->name('answer_update');


Route::get('/direct/{link}', 'DirectController' )->name('direct');



Route::get('/', function () {

    if (!Auth::check())  return view('welcome');

    return Auth::user()->is_manager? redirect()->route('manager'):redirect()->route('client') ;

})->name('welcome');
