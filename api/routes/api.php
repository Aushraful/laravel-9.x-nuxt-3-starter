<?php

use App\Http\Controllers\Api\V1\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

# Route Version Group
Route::group(['prefix' => 'v1'], function () {
    # UserController Group
    Route::controller(UserController::class)->group(function () {
        # Auth Routes
        Route::group(['prefix' => 'auth'], function () {
            Route::post('login', 'login');
            Route::post('register', 'register');
            Route::group(['middleware' => 'auth:api'], function () {
                Route::post('logout', 'logout');
                Route::post('refresh', 'refreshToken');
            });
        });

        # User Routes
        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('profile', 'profile');
        });
    });
});
