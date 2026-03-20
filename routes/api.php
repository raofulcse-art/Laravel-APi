<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/hello' , function(){
    return [ 'message' => 'Hello World'];
    //return 'Hello Wrold';
});

//Route::get('/show/{id}',[PostController::class,'show'])->name('posts.show');

Route::apiResource('posts',PostController::class);
require __DIR__.'/auth.php';