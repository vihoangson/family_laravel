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
Route::post('register', function(){
    return 'mo di cung';
});

Route::middleware('auth')
     ->group(function () {

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
         Route::middleware(['auth'])
              ->get('/', 'KyniemController@index')
              ->name('homepage');

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

     });
// End group check auth
/////////////////////

Route::post('/upload', 'KyniemController@gyazo')
     ->name('upload');
Route::get('/upload', function () {
    echo '<img src="/storage/images/Gyazo/' . base64_decode($_GET['file']) . '">';
    die;
})
     ->name('uploadg');



