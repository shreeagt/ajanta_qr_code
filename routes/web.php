<?php

use App\Http\Controllers\DoctorsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

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

// Route::get('/home', function () {
//     return view('home');
// });

// Route::get('/dashboard', function() {
//     return view('dashboard');
// });

Route::get('/test', function() {
    return view('test');
});

Route::get('/qrcode', function() {
    return view('qrcode');
});



Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/home', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

  
    Route::group(['middleware' => ['auth', 'permission']], function() {
        
        
        
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function() {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
            Route::get('/doctors/generate-pdf', 'DoctorsController@generateDoctorsPdf')->name('doctors.generate-pdf');
        });

       
        Route::get('/videoList', 'VideoController@index')->name('videoList');
        Route::get('/so_list', 'VideoController@getSoList')->name('video.solist');
       
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);

       
    });

    Route::group(['middleware' => ['auth', 'role:admin']], function () {
        Route::get('/doctors/generate-pdf', 'DoctorsController@generateDoctorsPdf')->name('doctors.generate-pdf');
    });

    Route::group(['middleware' => ['auth', 'role:so']], function () {
        Route::get('/doctors/create', 'DoctorsController@create')->name('doctors.create');
        Route::post('/doctors/create', 'DoctorsController@insertdoctors')->name('doctors.insert');
        Route::get('/doctors/show', 'DoctorsController@showdoctors')->name('doctors.show');
        // Route::get('/doctors/home/{doctor}', 'DoctorsController@link')->name('doctors.link');
        // Route::post('/doctors/upload', 'DoctorsController@upload')->name('doctors.upload');
        Route::delete('/doctors/{doctor}', 'DoctorsController@destroy')->name('doctors.destroy');
        Route::get('/doctors/{doctor}/edit', [DoctorsController::class, 'edit'])->name('doctors.edit');
        Route::put('/doctors/{doctor}', [DoctorsController::class, 'update'])->name('doctors.update');
    });

    Route::get('/videocreate', 'VideoController@create')->name('videocreate');
    Route::post('/videsave', 'VideoController@store')->name('videosave');    
    Route::patch('/{video_id}/update', 'VideoController@update')->name('videoupdate');
});

Route::group(['namespace' => 'App\Http\Controllers'], function() {
        Route::get('/doctors/home/{doctor}', 'DoctorsController@link')->name('doctors.link');
        Route::post('/doctors/upload', 'DoctorsController@upload')->name('doctors.upload');
});

