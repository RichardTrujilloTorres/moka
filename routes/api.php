<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    Route::namespace('Api')->group(function () {
        Route::prefix(env('API_VERSION', 'v1'))->group(function () {
            Route::resource('users', 'UsersController');
            Route::resource('roles', 'RolesController');
            Route::resource('permissions', 'PermissionsController');
            Route::resource('admins', 'AdminsController');
        });
    });
//});

Route::middleware('auth:sanctum')->group(function () {
    Route::namespace('Api')->group(function () {
        Route::prefix(env('API_VERSION', 'v1'))->group(function () {
            Route::get('histories/{resource}', 'HistoriesController@index');

            Route::get('storage-stats', 'StorageStatsController@index');
            Route::post('storage-stats/regenerate', 'StorageStatsController@regenerate');

            Route::get('search', 'SearchController@query');
        });
    });
});

