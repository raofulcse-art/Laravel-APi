<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;




//Route::get('/show/{id}',[PostController::class,'show'])->name('posts.show');
Route::middleware(['auth:sanctum','throttle:api'])->group(function (){
    Route::get('/user', function (Request $request) {
    return $request->user();
});
    Route::prefix('v1')->group(function(){
    Route::apiResource('posts',PostController::class);
});

});
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');
Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ->name('logout');

require __DIR__.'/auth.php';