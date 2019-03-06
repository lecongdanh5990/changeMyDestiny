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

Route::get('mission/today','MissionController@today');
Route::get('mission/{mission}/statuses','MissionController@getStatuses');
Route::resource('mission', 'MissionController',['except'=>['create','edit']]);
Route::get('mission/{mission}/steps/today', 'MissionStepsController@today');
Route::resource('mission.steps','MissionStepsController',['only' => ['index']]
);
Route::resource('mission.works','MissionWorksController',
    ['only' => ['index']]
);

Route::resource('step', 'StepController',['except'=>['create','edit']]);
Route::resource('step.statuses','StepStatusesController',['only' => ['index']]);
Route::resource('status.works','StatusWorksController',[' only' => ['index']]);

Route::get('work/today', 'WorkController@showToday');
Route::get('work/completed', 'WorkController@showCompleted');
Route::resource('work','WorkController',['except' => ['create ', 'show']]);


// Route::get('prodomo/getproofthisday/{day}', 'ProdomoController@getProOfThisDay');
// Route::resource('prodomo', 'ProdomoController', ['except' => ['create ', 'show']]);

Route::resource('test','TestController',
    ['except' => ['create', 'edit']]
);