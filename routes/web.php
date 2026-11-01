<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersinfoController;
use App\Http\Controllers\ChannelsController;
use App\Http\Controllers\VideoController;
use App\Models\Channel;

Route::get('/welcome', function(){return view('welcome');})->name('welcome');

Route::get('/', function(){return view('usersinfo');});

Route::post('/usersinfo', [UsersinfoController::class, 'store'])->name('usersinfo.store');

Route::get('/login', function(){return view('login');})->name('login');

Route::post('/login', [UsersinfoController::class, 'login'])->name('login.store');


Route::get('/profile', function(){

$channel = Channel::where('user_id', Auth::id())->first();

return view('profile', compact('channel'));
})->name('profile');

Route::get('/createChannel', function(){return view('createChannel');})->name('createChannel');

Route::post('/createChannel', [ChannelsController::class, 'store'])->name('channel.store');

Route::get('/myChannel', function(){
    $channel = Channel::where('user_id', Auth::id())->first();
    return view('myChannel', compact('channel'));
})->name('myChannel');
        
Route::get('/youtube', [VideoController::class, 'home'])->name('youtube')->middleware('auth');

Route::post('/myChannel', [VideoController::class, 'store'])->name('video.store');

Route::post('/logout', [UsersinfoController::class , 'logout'])->name('logout');

Route::get('/show-video/{id}', [VideoController::class, 'index'])->name('show-video');

use App\Http\Controllers\VideoLikeController;

Route::middleware('auth')->post('/videos/{video}/like', [VideoLikeController::class, 'toggle']
)->name('video-likes.toggle');