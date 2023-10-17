<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(\App\Http\Controllers\AuthController::class)->group(function (){
    Route::post('register','register');
    Route::post('login','login');
});

Route::controller(\App\Http\Controllers\BlogPostController::class)->group(function (){
    Route::get('get-all-blog-posts-by-user','getAllBlogsByUser')->middleware('auth');
    Route::get('get-blog-by-id/{id}','getBlogById')->middleware('auth');
    Route::get('get-all-blog-posts','getAllBlogs');

    Route::post('create-blog','createBlog')->middleware('auth');
    Route::post('edit-blog','editBlog')->middleware('auth');
    Route::post('delete-blog','deleteBlog')->middleware('auth');
});



