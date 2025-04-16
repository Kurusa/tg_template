<?php

namespace App\Enums;

use App\Http\Controllers\MainMenu;

enum UserStatus: string
{
    case MAIN_MENU = 'main_menu';

    public function handler(): string
    {
        return match ($this) {
            self::MAIN_MENU => MainMenu::class,
        };
    }
}
