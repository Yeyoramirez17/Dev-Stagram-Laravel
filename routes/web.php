<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class )->name('home');

Route::get('/register', [ RegisterController::class, 'index'] )->name( 'register.index' );
Route::post('/register', [ RegisterController::class, 'store'] )->name( 'register.store' );

Route::get('/login', [ LoginController::class, 'index'] )->name( 'login' );
Route::post('/login', [ LoginController::class, 'store'] );
Route::post('/logout', [ LogoutController::class, 'store' ])->name( 'logout' );

// Profile User
Route::get('/edit-profile', [ ProfileController::class, 'index' ])->name('profile.index');
Route::post('/edit-profile', [ ProfileController::class, 'store' ])->name('profile.store');

Route::get('/posts/create', [ PostController::class, 'create'] )->name( 'posts.create' );
Route::post('/posts', [ PostController::class, 'store'] )->name( 'posts.store' );
Route::delete('/posts/{post}', [ PostController::class , 'destroy'] )->name('posts.destroy');
Route::get('/{user:username}', [ PostController::class, 'index'] )->name( 'posts.index' );
Route::get('/{user:username}/posts/{post}', [ PostController::class, 'show'])->name( 'posts.show' );

Route::post('/{user:username}/posts/{post}', [ CommentController::class, 'store' ])->name( 'comment.store' );

Route::post('/image', [ ImageController::class, 'store' ])->name( 'images.store' );
Route::post('/remove-image', [ ImageController::class, 'destroyImage' ])->name( 'image.destroy' );

// Likes
Route::post('/posts/{post}/likes', [ LikeController::class, 'store'] )->name('post.likes.store');
Route::delete('/posts/{post}/likes', [ LikeController::class, 'destroy'] )->name('post.likes.destroy');

// Followers
Route::post('/{user:username}/follow', [ FollowerController::class, 'store'] )->name('users.follow');
Route::delete('/{user:username}/unfollow', [ FollowerController::class, 'destroy'] )->name('users.unfollow');
