<?php

use Illuminate\Support\Facades\Broadcast;

//Broadcast::channel('chat.{userId}', function ($user, $userId) {
//    return (int) $user->id === (int) $userId;
//});

//Broadcast::channel('typing-{userId}', function ($user, $userId) {
//    return true;
//});

Broadcast::channel('App.User.{id}',function ($user,$id) {
       return (int) $user->id === (int) $id;
});

Broadcast::channel('online', function ($user) {
      return $user;
});
