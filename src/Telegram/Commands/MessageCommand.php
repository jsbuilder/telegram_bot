<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

/**
 * This command can be triggered in two ways:
 * /start and /join due to the alias.
 */
class MessageCommand extends Command
{

    protected string $name = 'message';

    protected string $description = 'Any message';

    public function handle()
    {
        $message = $this->getUpdate()->getMessage();

        # This will update the chat status to "typing..."
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $this->replyWithMessage(
            [
                'text' =>
                    "Мы имеем данные по Вам\r\n" . print_r($message, true) . "\r\n" .
                    'Вы написали: ' . print_r($message->text, true)
            ]
        );
    }
}
