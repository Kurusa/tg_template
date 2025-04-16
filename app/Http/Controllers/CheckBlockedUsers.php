<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class CheckBlockedUsers extends BaseCommand
{
    public function handle(): void
    {
        if (!$this->user->isAdmin()) {
            return;
        }

        $this->getBot()->notifyAdmin('Починаю перевірку');
        Artisan::call('check-blocked-users');
    }
}
