<?php

use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Route;

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



//2.30.05

Auth::routes();

//THE ORDER OF ROUTES IS VERY IMPORTANT

//temporary email
Route::get('/email', function (){
    return new NewUserWelcomeMail();
});

//axios call
Route::post('/follow/{user}', [\App\Http\Controllers\FollowsController::class, 'store']);


//index route
Route::get('/', [\App\Http\Controllers\PostsController::class, 'index']);

//Make a route for post creation
Route::get('/p/create', [\App\Http\Controllers\PostsController::class, 'create']);

//save data from post
Route::post('/p/', [\App\Http\Controllers\PostsController::class, 'store']);

//route to get image
Route::get('/p/{post}',[\App\Http\Controllers\PostsController::class, 'show']);


//Fetching the index method inside the home controller
Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');

//edit profile
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');

