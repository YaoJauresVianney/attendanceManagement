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
    return view('auth.login');
});
// Routes sous-directions
Route::get('list-sous-dir', 'SousdirectionController@index');
Route::get('add-sous-dir', 'SousdirectionController@create');
Route::get('sous-dir/{id}/edit', 'SousdirectionController@edit');
Route::post('update-sous-dir', 'SousdirectionController@update');
Route::post('add-sous-dir', 'SousdirectionController@store');
Route::post('destroy-sous-dir/{id}', 'SousdirectionController@destroy');
// Routes services
Route::get('list-services', 'ServiceController@index');
Route::get('add-service', 'ServiceController@create');
Route::get('service/{id}/edit', 'ServiceController@edit');
Route::post('add-service', 'ServiceController@store');
Route::post('update-service', 'ServiceController@update');
Route::post('destroy-service/{id}', 'ServiceController@destroy');
// Routes agents
Route::get('list-agents', 'AgentController@index');
Route::get('add-agents', 'AgentController@create');
Route::get('agent/{id}/edit', 'AgentController@edit');
Route::post('update-agent', 'AgentController@update');
Route::post('add-agent', 'AgentController@store');
Route::post('destroy-agent/{id}', 'AgentController@destroy');
// Routes pointages
Route::get('list-pointages', 'PointageController@index');
Route::post('add-pointages', 'PointageController@store');
Route::post('update-pointage', 'PointageController@update');
Route::get('list-users', 'UserController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
