<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

/**
 * This command can be triggered in two ways:
 * /start and /join due to the alias.
 */
class TestButton1Command extends Command
{

    protected string $name = 'test_button1';

    protected string $description = 'Test Button1';

    public function handle()
    {
        $message = $this->getUpdate()->getMessage();
        # This will update the chat status to "typing..."
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $this->replyWithMessage(
            [
                'text' => "мы имеем данные по вам\r\n"
                    . print_r($message, true)
                    . "\r\nВы нажали button1"
            ]
        );

    }
}
