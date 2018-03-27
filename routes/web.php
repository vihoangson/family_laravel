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
Route::get('/', 'KyniemController@index');
Route::get('/overview', 'KyniemController@overview');

Route::get('/api/data', 'api\DataController@index');
Route::get('/api/getkyniem', 'api\DataController@get_ky_niem');

Route::get('/api/box_add', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('welcome');
});
