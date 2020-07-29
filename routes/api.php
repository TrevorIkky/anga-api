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

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/exists', 'AuthController@userExists');
});

Route::group(['prefix'=>'subscription'], function(){
    Route::get('/all', 'SubscriptionController@index');
    Route::get('/show/{id}', 'SubscriptionController@show');
    Route::put('/add', 'SubscriptionController@store');
    Route::delete('/delete/{id}', 'SubscriptionController@destroy');
});

Route::group(['prefix'=>'relation'], function(){
    Route::put('/add', 'UserRelationMappingController@createRelation');
    Route::patch('/update', 'UserRelationMappingController@updateRelation');
    Route::post('/isRelated', 'UserRelationMappingController@checkIfRelated');
});

Route::group(['prefix'=>'subtopic'], function(){
    Route::get('/all', 'SubtopicController@index');
});

Route::group(['prefix'=>'analysis'], function(){
    Route::post('/weatherdata', 'AnalysisController@getWeatherData');
});