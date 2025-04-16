<?php

namespace App\Services\Keyboard;

use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class MainMenuKeyboardService
{
    public static function createMainMenuKeyboard(): ReplyKeyboardMarkup
    {
        return new ReplyKeyboardMarkup([
            [
                __('texts.language_settings'),
            ],
        ], false, true);
    }
}
