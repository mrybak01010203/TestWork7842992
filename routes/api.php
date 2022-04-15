<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\MembersController;

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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
 

});
*/
 //Route::apiResource('projects', ProjectController::class);
 //Route::apiResource('members', MembersController::class);
 //Route::get('fndprojcts', [ProjectController::class, 'findproj']);
 Route::post('findmembs', [MembersController::class, 'findmembs'])->middleware('api_token');;
 //Route::apiResource('fndprojcts', 'App\Http\Controllers\API\ProjectController@findproj');
