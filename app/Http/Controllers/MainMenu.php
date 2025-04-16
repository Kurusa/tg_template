<?php

namespace App\Http\Controllers;

use App\Enums\UserStatus;
use App\Services\Keyboard\MainMenuKeyboardService;
use function __;

class MainMenu extends BaseCommand
{
    public function handle(): void
    {
        $this->user->setStatus(UserStatus::MAIN_MENU);

        $this->getBot()->sendMessageWithKeyboard(
            __('texts.select_action'),
            MainMenuKeyboardService::createMainMenuKeyboard(),
        );
    }
}
