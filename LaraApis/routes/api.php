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


Route::prefix('/members')->group(function () {
    Route::get('/', 'Apis\Sample\SampleApi@index');
    Route::post('/', 'Apis\Sample\SampleApi@store');
});

Route::prefix('/nuxt-schedule')->group(function() {
    Route::prefix('/members')->group(function() {
        Route::get('/', 'Apis\NuxtSchedule\MemberApi@index');
        Route::post('/', 'Apis\NuxtSchedule\MemberApi@store');
        Route::put('/{id}', 'Apis\NuxtSchedule\MemberApi@update');
        Route::delete('/{id}', 'Apis\NuxtSchedule\MemberApi@delete');
    });

    Route::prefix('/projects')->group(function() {
        Route::get('/', 'Apis\NuxtSchedule\ProjectApi@index');
        Route::post('/', 'Apis\NuxtSchedule\ProjectApi@store');
        Route::put('/{id}', 'Apis\NuxtSchedule\ProjectApi@update');
        Route::delete('/{id}', 'Apis\NuxtSchedule\ProjectApi@delete');

        Route::get('/{id}/memos', 'Apis\NuxtSchedule\ProjectApi@indexMemo');
        Route::post('/{id}/memo', 'Apis\NuxtSchedule\ProjectApi@storeMemo');
    });
});