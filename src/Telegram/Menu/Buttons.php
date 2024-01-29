<?php

namespace App\Telegram\Menu;

use Telegram\Bot\Keyboard\Keyboard;

/**
 *
 */
class Buttons
{

    public function getByCommands(array $commands): Keyboard
    {
        $buttons = [];
        foreach ($commands as $name => $command) {
            if(!$command instanceof MainMenuButtonInterface) {
                continue;
            }
            $buttons[] = Keyboard::inlineButton(
                [
                    'text'          => $command->getDescription(),
                    'callback_data' => $name
                ]
            );
        }

        return Keyboard::make()->inline()->row($buttons);
    }
}
