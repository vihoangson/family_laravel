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
Route::get('/kyniem/calendar', 'KyniemController@calendar')
     ->name('kyniem_calendar');
Route::get('/kyniem/edit', 'KyniemController@edit')
     ->name('kyniem_edit');

Route::get('/kyniem/delete', 'KyniemController@delete')
     ->name('kyniem_delete');
Route::get('/overview', 'KyniemController@overview')
     ->name('overview');
Route::post('/kyniem/store', 'KyniemController@store')
     ->name('kyniem_store');

Route::get('/admin/options', 'admin\OptionsController@index')
     ->name('option_index');
Route::get('/', 'KyniemController@index')
     ->name('homepage');
Route::post('/upload', 'KyniemController@gyazo')
     ->name('upload');
Route::get('/upload', function(){
    return '<img src="/storage/images/Gyazo/'.base64_decode($_GET['file']).'">';
})
     ->name('uploadg');

Route::group(['middleware' => 'App\Http\Middleware\CheckApi'], function () {
    Route::group(['prefix' => 'api'], function () {
        Route::post('/hookchatwork', 'api\AIController@hookchatwork')
             ->name('api_hookchatwork');
        Route::post('/chatnham', 'api\AIController@chatNham')
             ->name('api_chatnham');
        Route::get('/flag_deploy', 'api\AIController@flag_deploy')
             ->name('api_flag_deploy');
        Route::get('/deploy_done', 'api\AIController@deploy_done')
             ->name('api_deploy_done');
    });
});


Route::get('/api/data', 'api\DataController@index')
     ->name('api_data');
Route::get('/api/getkyniem', 'api\DataController@get_ky_niem')
     ->name('api_getkyniem');
Route::post('/ajax_up_files', 'api\DataController@ajax_up_files')
     ->name('api_ajaxupfiles');
Route::post('/get_calendar', 'api\DataController@get_calendar')
     ->name('api_get_calendar');

Route::get('/api/box_add', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('welcome');
});
