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

Route::get('/kyniem/edit', 'KyniemController@edit')->name('kyniem_edit');

Route::get('/kyniem/delete', 'KyniemController@delete')->name('kyniem_delete');
Route::get('/overview', 'KyniemController@overview')->name('overview');
Route::post('/kyniem/store', 'KyniemController@store')->name('kyniem_store');

Route::resource('post','PostsController');

Route::get('/admin/options', 'admin\OptionsController@index')->name('option_index');
Route::get('/', 'KyniemController@index')->name('homepage');

Route::get('/api/data', 'api\DataController@index')->name('api_data');
Route::get('/api/getkyniem', 'api\DataController@get_ky_niem')->name('api_getkyniem');
Route::post('/ajax_up_files', 'api\DataController@ajax_up_files')->name('api_ajaxupfiles');

Route::get('/api/box_add', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('welcome');
});
