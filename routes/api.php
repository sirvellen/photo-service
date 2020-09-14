<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/test', function () {
    return __DIR__ . '/../index.php';
})->name('my route');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', 'UserController@index');

Route::post('/users/signup', 'UserController@store');

Route::post('/users/login', 'UserController@login');

Route::middleware('auth:api')->post('/users/logout', 'UserController@logout');

Route::prefix('photo')->group(function () {
    Route::get('/', 'PhotoController@index');
    Route::get('/{photo}', 'PhotoController@show');
    Route::middleware('auth:api')->post('/', 'PhotoController@store');
    Route::middleware('auth:api')->patch('/{photo}', 'PhotoController@update');
    Route::middleware('auth:api')->delete('/{photo}', 'PhotoController@destroy');
});

Route::prefix('categories')->group(function () {
    Route::get('/', 'CategoryController@index');
    Route::get('/{category}', 'CategoryController@show');
    Route::middleware('auth:api')->post('/', 'CategoryController@store');
    Route::middleware('auth:api')->patch('/{category}', 'CategoryController@update');
    Route::middleware('auth:api')->delete('/{category}', 'CategoryController@destroy');

    Route::prefix('/{category}/products')->group(function () {
        Route::get('/', 'ProductController@index');
        Route::get('/{product}', 'ProductController@show');
        Route::middleware('auth:api')->post('/', 'ProductController@store');
        Route::middleware('auth:api')->patch('/{product}', 'ProductController@update');
        Route::middleware('auth:api')->delete('/{product}', 'ProductController@destroy');
    });
});