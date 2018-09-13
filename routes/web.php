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

//<editor-fold desc="Auth router">
// Authentication Routes...
Route::get('login', [
    'as'   => 'login',
    'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
    'as'   => '',
    'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
    'as'   => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);

// Password Reset Routes...
Route::post('password/email', [
    'as'   => 'password.email',
    'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
    'as'   => 'password.request',
    'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
    'as'   => '',
    'uses' => 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
    'as'   => 'password.reset',
    'uses' => 'Auth\ResetPasswordController@showResetForm'
]);

// Registration Routes...
Route::get('register', [
    'as'   => 'register',
    'uses' => 'Auth\RegisterController@showRegistrationForm'
]);
Route::post('register', [
    'as'   => '',
    'uses' => 'Auth\RegisterController@register'
]);
Route::post('register', [
    'as'   => '',
    'uses' => 'Auth\RegisterController@register'
]);
//</editor-fold>

/////////////////////
// Start group check auth
Route::middleware('auth')
     ->group(function () {
         // Route homepage
         Route::get('/', 'KyniemController@index')
              ->name('homepage');

         // Group kyniem
         Route::group(['prefix' => 'kyniem'], function () {
             Route::get('/calendar', 'KyniemController@calendar')
                  ->name('kyniem_calendar');
             Route::get('/edit', 'KyniemController@edit')
                  ->name('kyniem_edit');

             Route::get('/delete', 'KyniemController@delete')
                  ->name('kyniem_delete');

             Route::post('/store', 'KyniemController@store')
                  ->name('kyniem_store');
             Route::get('/search', 'KyniemController@search')
                  ->name('kyniem_search');
         });

         // Controller media
         Route::resource('/admin/media','admin\MediaController');

         // Controller media
         Route::resource('/admin/cloud','admin\CloudController');

         // Overview
         Route::get('/overview', 'KyniemController@overview')
              ->name('overview');

         // Group admin
         Route::group(['prefix' => 'admin'], function () {
             Route::get('/options', 'admin\OptionsController@index')
                  ->name('admin_options');
             Route::post('/options', 'admin\OptionsController@store')
                  ->name('admin_options_save');

         });

         // Group api
         Route::group(['middleware' => 'App\Http\Middleware\CheckApi'], function () {
             Route::group(['prefix' => 'api'], function () {
                 Route::get('/data', 'api\DataController@index')
                      ->name('api_data');
                 Route::get('/getkyniem', 'api\DataController@get_ky_niem')
                      ->name('api_getkyniem');
                 Route::get('/box_add', function () {
                     return view('welcome');
                 });
             });
         });

         Route::group(['prefix' => '/admin/cache'], function () {
             Route::get('/clear_cache_options', 'admin\CacheController@clearCacheOptions')
                  ->name('clear_cache_options');

         });

         // API upload file
         Route::post('/ajax_up_files', 'api\DataController@ajax_up_files')
              ->name('api_ajaxupfiles');

         Route::post('/get_calendar', 'api\DataController@get_calendar')
              ->name('api_get_calendar');


         Route::get('/family_tree', function () {
             return view('family_tree.index');
         })->name('family-tree-index');

     });
// End group check auth
/////////////////////

// API Ai
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

//<editor-fold desc="upload gyazo">
Route::post('/upload', 'GyazoController@gyazo')
     ->name('upload');
Route::get('/upload', function () {
    sleep(2);
    $link = \App\Libraries\CloudinaryLib::searchFileInCloud(base64_decode($_GET['file']));
    echo '<img src="'.$link['url'].'">';
    die;
})
     ->name('uploadg');
//</editor-fold>




