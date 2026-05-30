<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// Online Users Track
Broadcast::channel('online-students', function ($user) {

    return [
        'id'   => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'photo' => $user->photo ? asset('storage/'.$user->photo) : asset('default.png'),
        'roll' => $user->roll,
        'role' => $user->role,
    ];

});
