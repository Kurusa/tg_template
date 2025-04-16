<?php

use App\Http\Controllers\Back;
use App\Http\Controllers\Channel\PromptChannelManagementMenu;
use App\Http\Controllers\CheckBlockedUsers;
use App\Http\Controllers\City\Create\PromptCreateCityOptions;
use App\Http\Controllers\City\PromptCityManagementMenu;
use App\Http\Controllers\City\PromptDistrictList;
use App\Http\Controllers\MainMenu;
use App\Http\Controllers\Notification\PromptNotificationManagementMenu;
use App\Http\Controllers\Setting\Feedback;
use App\Http\Controllers\Setting\Language\PromptSelectLanguage;
use App\Http\Controllers\Weather\SelectWeatherCity;

return [
    'telegram_bot_token' => env('TELEGRAM_BOT_TOKEN'),
    'admin_chat_id' => env('ADMIN_CHAT_ID'),

    'handlers' => [
        'keyboard' => [
            'back' => Back::class,
            'feedback' => Feedback::class,
            'language_settings' => PromptSelectLanguage::class,
        ],

        'slash' => [
            '/start' => MainMenu::class,
            '/language' => PromptSelectLanguage::class,
            '/feedback' => Feedback::class,
            '/blocked' => CheckBlockedUsers::class,
        ],
    ],

    'languages' => [
        'uk' => '🇺🇦Українська',
        'en' => '🇺🇸English',
    ],
];
