<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;



Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('chatting', function ($user) {
    return Auth::check();
});
