<?php

use App\Http\Controllers\NotiController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::group(['prefix' => 'profile'], function () {
    Route::get('/{user}/reset_password', 'ProfileController@resetPassword')->name('profile.reset_password');
    Route::patch('/{user}/update_password', 'ProfileController@updatePassword')->name('profile.update_password');
});


Route::get('/about', function () {
    return view('about');
})->name('about');

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

//    Route::group(['middleware' => ['guest']], function () {
//        /**
//         * Register Routes
//         */
//        Route::get('/register', 'RegisterController@show')->name('register.show');
//        Route::post('/register', 'RegisterController@register')->name('register.perform');
//
//        /**
//         * Login Routes
//         */
//        Route::get('/login', 'LoginController@show')->name('login.show');

Route::post('/login', 'Auth\LoginController@login')->name('login.perform');
//
//    });

    Route::group(['middleware' => ['auth', 'permission']], function () {
        /**
         * Logout Routes
         */
     //   Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::get('/search', 'UsersController@search')->name('users.search');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
            Route::patch('/savechange', 'UsersController@savechange')->name('users.savechange');
            Route::get('/{user}/admin_reset_password', 'UsersController@adminResetpassword')->name('users.admin_reset_password');
            Route::patch('/{user}/admin_update_password', 'UsersController@adminUpdatePassword')->name('users.admin_update_password');
        });
        Route::group(['prefix' => 'models'], function () {
            Route::get('/', 'ModelsController@index')->name('models.index');
            Route::get('/create', 'ModelsController@create')->name('models.create');
            Route::post('/store', 'ModelsController@store')->name('models.store');
            Route::get('/{model}/show', 'ModelsController@show')->name('models.show');
            Route::get('/{model}/edit', 'ModelsController@edit')->name('models.edit');
            Route::post('/{model}/update', 'ModelsController@update')->name('models.update');
            Route::get('/{model}/delete', 'ModelsController@delete')->name('models.delete');
            Route::post('/updateSelected', 'ModelsController@updateSelected')->name('models.updateSelected');
        });
        Route::group(['prefix' => 'predict'], function () {
            Route::get('/', 'PredictionsController@index')->name('predict.index');
            Route::get('/create', 'PredictionsController@create')->name('predict.create');
            Route::post('/store', 'PredictionsController@store')->name('predict.store');
            Route::get('/edit/{id}', 'PredictionsController@edit')->name('predict.edit');
            Route::post('/update', 'PredictionsController@update')->name('predict.update');
            Route::get('/show/{id}', 'PredictionsController@show')->name('predict.show');
            Route::get('/delete/{id}', 'PredictionsController@delete')->name('predict.delete');
            Route::post('/upload-image', 'PredictionsController@uploadImage')->name('predict.upload');

            Route::post('/doctor/confirm', 'PredictionsController@doctorConfirm')->name('predict.doctor.confirm');

        });

        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);

        /**
         * Patient Routes
         */
        Route::group(['prefix' => 'patients'], function () {
            Route::get('/', 'PatientController@index')->name('patients.index');
            Route::get('/create', 'PatientController@create')->name('patients.create');
            Route::post('/create', 'PatientController@store')->name('patients.store');
            Route::get('/{patient}/show', 'PatientController@show')->name('patients.show');
            Route::get('/{patient}/edit', 'PatientController@edit')->name('patients.edit');
            Route::patch('/{patient}/update', 'PatientController@update')->name('patients.update');
            Route::delete('/{patient}/delete', 'PatientController@destroy')->name('patients.destroy');
        });
        Route::get('/send', 'NotiController@sendNoti')->name('notification.send');
        Route::get('/notification-load', 'NotiController@loadNoti')->name('notification.load');
        Route::get('/notification/index', 'NotiController@index')->name('notification.index');
        Route::get('/notification-update/{id}', 'NotiController@updateNoti')->name('notification.update');
        Route::group(['prefix' => 'notification'], function () {
            Route::post('/send_token', 'NotiController@updateToken')->name('notification.send_token');
        });
    });
