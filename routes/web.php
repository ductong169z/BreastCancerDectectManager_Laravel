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
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
        });

        Route::group(['prefix' => 'predict'], function () {
            Route::get('/', 'PredictController@index')->name('predict.index');
            Route::get('/create', 'PredictController@create')->name('predict.create');
            Route::post('/store', 'PredictController@store')->name('predict.store');
            Route::get('/edit/{id}', 'PredictController@edit')->name('predict.edit');
            Route::post('/update', 'PredictController@update')->name('predict.update');

        });

        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
    });
