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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

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
//        Route::post('/login', 'LoginController@login')->name('login.perform');
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
        });
        Route::group(['prefix' => 'models'], function () {
            Route::get('/', 'ModelsController@index')->name('models.index');
            Route::get('/create', 'ModelsController@create')->name('models.create');
            Route::post('/store', 'ModelsController@store')->name('models.store');
            Route::get('/{model}/show', 'ModelsController@show')->name('models.show');
            Route::get('/{model}/edit', 'ModelsController@edit')->name('models.edit');
            Route::post('/{model}/update', 'ModelsController@update')->name('models.update');
            Route::get('/{model}/delete', 'ModelsController@delete')->name('models.delete');
        });
        Route::group(['prefix' => 'predict'], function () {
            Route::get('/', 'PredictController@index')->name('predict.index');
            Route::get('/create', 'PredictController@create')->name('predict.create');
            Route::post('/store', 'PredictController@store')->name('predict.store');
            Route::get('/edit/{id}', 'PredictController@edit')->name('predict.edit');
            Route::post('/update', 'PredictController@update')->name('predict.update');
            Route::get('/show/{id}', 'PredictController@show')->name('predict.show');
            Route::get('/delete/{id}', 'PredictController@delete')->name('predict.delete');

            Route::post('/sonographer/confirm', 'PredictController@sonographerConfirm')->name('predict.sonographer.confirm');
            Route::post('/doctor/confirm', 'PredictController@doctorConfirm')->name('predict.doctor.confirm');

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
    });
