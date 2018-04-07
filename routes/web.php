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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'issues'], function() {
    Route::get('/', 'IssueController@index')->name('issuesIndex');
    Route::get('/create', 'IssueController@create')->name('createIssue');
    Route::post('/', 'IssueController@store')->name('storeIssue');
    Route::get('{issue}', 'IssueController@show')->name('showIssue');
    Route::get('{issue}/edit', 'IssueController@edit')->name('editIssue');
    Route::put('{issue}', 'IssueController@update')->name('updateIssue');
    Route::delete('{issue}', 'IssueController@destroy')->name('deleteIssue');

});
