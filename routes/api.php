<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::middleware('auth:sanctum')->group(function(){
    
    Route::get('/user', function (Request $request) {
        if($request->user()->type != 1){
            return response()->json([
                'status' => 500,
                'Unauthorized'
            ]);
        }
        return User::all();
    }); 
});
Route::post('/login', [AuthController::class, 'login' ])->name('api-login');
// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::apiResource('/users', UserController::class);
// });

// // Route::get('/login', [LoginController::class, 'login'])->name('login');
// Route::post('/login', [LoginController::class, 'postLogin'])->name('postLogin');

