<?php

namespace App\Telegram\Commands;

use App\Telegram\Menu\MainMenuButtonInterface;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

/**
 * This command can be triggered in two ways:
 * /start and /join due to the alias.
 */
class HelpCommand extends Command implements MainMenuButtonInterface
{

    protected string $name = 'help';

    protected string $description = 'Справка';

    public function handle()
    {
        # This will update the chat status to "typing..."
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $this->replyWithMessage(
            [
                'text' => "Help Commands"
            ]
        );

    }
}
