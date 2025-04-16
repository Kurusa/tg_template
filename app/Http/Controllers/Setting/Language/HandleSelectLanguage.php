<?php

namespace App\Http\Controllers\Setting\Language;

use App\Http\Controllers\BaseCommand;
use App\Http\Controllers\MainMenu;
use App\Services\Keyboard\LanguageKeyboardService;

class HandleSelectLanguage extends BaseCommand
{
    public function handle(): void
    {
        $languageCode = $this->update->getCallbackQueryByKey('lang');

        if ($this->user->language !== $languageCode) {
            $this->user->update(['language' => $languageCode]);

            app()->setLocale($languageCode);

            $this->getBot()->sendMessageWithKeyboard(
                __('texts.select_language'),
                LanguageKeyboardService::createLanguageKeyboard(),
                $this->update->getCallbackQueryMessageId(),
            );

            $this->triggerCommand(MainMenu::class);
        }
    }

    public function handleCallbackQuery(): void
    {
        $languageCode = $this->update->getCallbackQueryByKey('lang');

        $this->getBot()->answerCallbackQuery(
            $this->update->getCallbackQuery()->getId(),
            __('texts.language_updated', [
                'language' => config("telegram.languages.{$languageCode}"),
            ]),
        );
    }
}
