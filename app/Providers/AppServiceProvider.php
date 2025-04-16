<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use App\Services\Handlers\UpdateProcessorService;
use App\Services\Handlers\Updates\TextOrCallbackQueryHandler;
use App\Utils\Api;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use TelegramBot\Api\Client as TelegramClient;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot(): void
    {
        $this->app->bind(UpdateProcessorService::class, function ($app) {
            return new UpdateProcessorService([
                $app->make(TextOrCallbackQueryHandler::class),
            ]);
        });

        $this->app->singleton(TelegramClient::class, function () {
            return new TelegramClient(config('telegram.telegram_bot_token'));
        });

        $this->app->singleton(Api::class, function () {
            return new Api(config('telegram.telegram_bot_token'));
        });

        Carbon::setLocale(app()->getLocale());
        User::observe(UserObserver::class);
    }
}
