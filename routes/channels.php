<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    $isAuthorized =  (int) $user->id === (int) $id;
    // dd('authorization', $isAuthorized);
    return $isAuthorized;
});

Broadcast::channel('likeChannel', function () {
    return true;
});
