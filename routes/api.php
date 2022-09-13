<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RealStateController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\Auth\LoginJwtController;

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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){

    Route::post('login', [LoginJwtController::class, 'login'])->name('login');
    Route::get('logout', [LoginJwtController::class, 'logout'])->name('logout');
    Route::get('refresh', [LoginJwtController::class, 'refresh'])->name('refresh');


    Route::group(['middleware' => ['jwt.auth']], function() {

        Route::name('real_states')->group(function(){
            Route::resource('real-states', RealStateController::class);
        });

        Route::name('users')->group(function(){
            Route::resource('users', UserController::class);
        });

        Route::name('categories')->group(function(){

            Route::get('categories/{id}/real-states', [CategoryController::class, 'realStates']);

            Route::resource('categories', CategoryController::class);
        });

        Route::name('photos')->prefix('photos')->group(function(){
            Route::delete('/{id}', [\App\Http\Controllers\Api\RealStatePhotoController::class, 'remove'])->name('delete');
            Route::put('/set-thumb/{photoId}/{realStateId}', [\App\Http\Controllers\Api\RealStatePhotoController::class, 'setThumb'])->name('update');
        });
    });

});
