<?php

namespace App\Http\Controllers\Setting\Language;

use App\Http\Controllers\BaseCommand;
use App\Services\Keyboard\LanguageKeyboardService;

class PromptSelectLanguage extends BaseCommand
{
    public function handle(): void
    {
        $this->getBot()->sendMessageWithKeyboard(
            __('texts.select_language'),
            LanguageKeyboardService::createLanguageKeyboard(),
        );
    }
}
