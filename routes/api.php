<?php

use App\Http\Controllers\BoardsController;
use App\Http\Controllers\DashboardChartsController;
use App\Http\Controllers\DashboardChartTopicsController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\UsersController;
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

Route::group(['prefix'=>'v1','namespace'=>'App\Http\Controllers'],function(){
    Route::get('users', [UsersController::class,'index']);
    Route::resource('topics', TopicsController::class);
    Route::get('topics/delete/all', [TopicsController::class,'destroyAll']);
    Route::get('topics/subscribe/topic', [TopicsController::class,'subscribe']);
    Route::resource('dashboards', DashboardsController::class);
    Route::resource('dashboard/charts', DashboardChartsController::class);
    Route::post('dashboard/sync/topic', [DashboardChartTopicsController::class,'syncTopic']);
    Route::apiResource('charts', ChartsController::class);
    Route::apiResource('boards', BoardsController::class);
    Route::post('boards/output/update/{id}', [BoardsController::class,'syncOutput']);
   
   // Route::get('unauthenticated', 'AuthController@refresh')->name('unauthenticated');
    
     Route::get('unauthenticated', function (){        
        return response()->json(['error' => 'No autorizado'],403);
    })->name('unauthenticated'); 
   
 });


