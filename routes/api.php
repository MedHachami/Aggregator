<?php

use App\Http\Controllers\FavorisController;
use App\Http\Controllers\Post;
use App\Http\Controllers\UserController;
use App\Models\User;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DashboardController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/posts', [Post::class, 'getPostsNotAuth']);
Route::get('/comments/{postId}', [Post::class, 'getCommentsByPost']);




Route::middleware('auth:api')->group(function () {
    Route::get('get-user', [AuthController::class, 'userInfo']);
    Route::post('favoris/{postId}', [FavorisController::class, 'makeFavoritePost']);
    Route::get('/favorites', [Post::class, 'favoritesPost']);

    // if user is logged in
    Route::get('/newData', [Post::class, 'getPosts']);
    Route::get('/post/{postId}', [Post::class, 'getPostByid']);
    // Route::get('/getUsers', [UserController::class, 'allUsers']);
    Route::post('addComment' , [Post::class , 'addComment']);







});
