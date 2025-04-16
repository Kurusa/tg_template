<?php

namespace App\Observers;

use App\Models\User;
use App\Utils\Api;

class UserObserver
{
    public function created(User $user): void
    {
        /** @var Api $api */
        $api = app(Api::class);
        $api->notifyAdmin("New user was created: @{$user->user_name}");
    }
}
