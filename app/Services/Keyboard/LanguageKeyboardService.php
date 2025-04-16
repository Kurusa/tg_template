<?php

namespace App\Services\Keyboard;

use App\Enums\CallbackAction\CallbackAction;
use App\Models\User;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;

class LanguageKeyboardService
{
    public static function createLanguageKeyboard(): InlineKeyboardMarkup
    {
        /** @var User $user */
        $user = request()->get('user');
        $currentLanguage = $user->language;

        $languages = config('telegram.languages');

        return new InlineKeyboardMarkup(collect($languages)
            ->map(function ($label, $code) use ($currentLanguage) {
                $status = $code === $currentLanguage ? ' ✅' : '';

                return [
                    'text' => $label . $status,
                    'callback_data' => json_encode([
                        'lang' => $code,
                        'a' => CallbackAction::LANGUAGE_SELECT->value,
                    ]),
                ];
            })
            ->chunk(2)
            ->map(fn($chunk) => $chunk->values()->toArray())
            ->toArray());
    }
}
