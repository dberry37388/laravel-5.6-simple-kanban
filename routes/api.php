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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api', 'throttle:60,1'], function() {

    Route::group(['prefix' => 'lanes'], function() {
        Route::get('{lane}/issues', function ($lane) {
            return \App\Http\Resources\IssueResource::collection(\App\Issue::where('lane_id', $lane)->paginate());
        });
    });

    Route::group(['prefix' => 'issues'], function() {
        Route::get('/', function () {
            return \App\Http\Resources\IssueResource::collection(\App\Issue::paginate());
        });

        Route::get('{issue}', function ($issue) {
            return \App\Http\Resources\IssueResource::make(\App\Issue::where('id', $issue)->first());
        });
    });
});
