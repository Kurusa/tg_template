<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Utils\Api;
use Exception;
use Illuminate\Console\Command;

class CheckBlockedUsers extends Command
{
    protected $signature = 'check-blocked-users';

    public function handle(): void
    {
        /** @var Api $api */
        $api = app(Api::class);

        $users = User::all();

        $this->info('Починаю перевірку');

        /** @var User $user */
        foreach ($users as $user) {
            try {
                $api->setChatId($user->chat_id);
                $api->sendChatAction($user->chat_id, 'typing');

                if ($user->is_blocked === true) {
                    $user->update(['is_blocked' => false]);
                    $api->notifyAdmin("Користувач: {$user->id} розблокував бота");
                    $this->info("Користувач: {$user->id} розблокував бота");
                }
            } catch (Exception $e) {
                if (str_contains($e->getMessage(), 'Too many')) {
                    $this->info('Sleeping');
                    sleep(10);
                }

                if (str_contains($e->getMessage(), 'user is deactivated')) {
                    $api->notifyAdmin("Користувач: {$user->user_name} видалений");
                    $this->alert("Користувач: {$user->user_name} видалений");
                    $user->delete();
                    continue;
                }

                if ($user->is_blocked === false) {
                    $user->update(['is_blocked' => true]);
                    $api->notifyAdmin("Користувач: {$user->id} заблокував бота");
                    $this->alert("Користувач: {$user->id} заблокував бота");
                }
            }
        }

        $this->info('Перевірка завершена');
    }
}
