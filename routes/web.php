<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;


//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function(){
       return redirect()->route('login');
 });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

   Route::resource('messages', MessageController::class);

  // Route::view('pusher','pusher');

Route::group(['middleware' => 'auth'],function (){

      Route::get('users',[ChatController::class,'index']);

      Route::get('chat/{receiverId}',[ChatController::class,'chat'])->name('chat');

   //   Route::post('chat/{receiverId}/send',[ChatController::class,'sendMessage']);

      Route::post('chat/typing',[ChatController::class,'typing']);

      Route::post('online',[ChatController::class,'setOnline']);

      Route::post('offline',[ChatController::class,'setOffline']);

});

    Route::post('/user/save', [UserController::class, 'save'])->name('user.save');

    Route::post('/user/check', [UserController::class, 'check'])->name('user.check');

    Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');

    Route::get('/user/login', [UserController::class, 'login'])->name('user.login');

    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::get('/user/register', [UserController::class, 'register'])->name('user.register');

    Route::get('/user/profileview', [UserController::class, 'profile'])->name('user.profileview');

    Route::get('/user/profileedit', [UserController::class, 'edit'])->name('user.profileedit');

    Route::get('/user/chats', [UserController::class, 'chats'])->name('user.chats');

    Route::put('/user/updateProfile', [UserController::class, 'updateProfile'])->name('user.updateProfile');

    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    Route::get('/fetch-messages', [ChatController::class, 'fetchMessages'])->name('fetch.messages');

    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send.message');

