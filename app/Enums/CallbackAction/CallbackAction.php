<?php

namespace App\Enums\CallbackAction;

use App\Http\Controllers\Setting\Language\HandleSelectLanguage;

enum CallbackAction: int implements CallbackActionEnum
{
    case LANGUAGE_SELECT = 1;

    public function handler(): string
    {
        return match ($this) {
            self::LANGUAGE_SELECT => HandleSelectLanguage::class,
        };
    }
}
