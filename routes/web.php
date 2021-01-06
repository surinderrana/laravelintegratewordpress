<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/login', [UserController::class, 'loginview'])->name('login');
Route::post('/logincheck', [UserController::class, 'logindetails'])->name('logincheck');
Route::get('/dashbord', [UserController::class, 'viewdasbord'])->name('dashbord');

Route::get('/addpost', [PostController::class, 'addpost'])->name('addpost');
Route::post('/addpostdata', [PostController::class, 'postdetails'])->name('addpostdata');
Route::get('/allposts', [PostController::class, 'getallposts'])->name('allposts');
Route::get('/updateposts', [PostController::class, 'updatepost'])->name('updateposts');
Route::get('/updatedataposts', [PostController::class, 'update_post_data'])->name('updatedataposts');
Route::get('/deleteposts', [PostController::class, 'delete_post'])->name('deleteposts');
Route::get('/updatetags', [PostController::class, 'update_tags'])->name('updatetags');
Route::get('/test', [PostController::class, 'test'])->name('test');