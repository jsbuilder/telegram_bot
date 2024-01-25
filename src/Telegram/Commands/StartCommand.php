<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

/**
 * This command can be triggered in two ways:
 * /start and /join due to the alias.
 */
class StartCommand extends Command
{
    protected string $name = 'start';
    protected array $aliases = ['join'];
    protected string $description = 'Start Command to get you started';
    protected string $pattern = '{username}
    {age: \d+}';

    public function handle()
    {
        $message = $this->getUpdate()->getMessage();

        # Get the username argument if the user provides,
        # (optional) fallback to username from Update object as the default.
        $username = $this->argument(
            'username',
            $message->from->first_name . ' ' . $message->last_name
        );

        $this->replyWithMessage(
            [
            'text' => "Здравствуйте {$username}! Welcome to our bot, Here are our available commands:"
            ]
        );

        # This will update the chat status to "typing..."
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        # Get all the registered commands.
        $commands = $this->getTelegram()->getCommands();

        $response = '';
        foreach ($commands as $name => $command) {
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }

        $this->replyWithMessage(['text' => $response]);

        if($this->argument('age', 0) >= 18) {
            $this->replyWithMessage(['text' => 'Test bot']);
        } else {
            $this->replyWithMessage(['text' => 'Sorry, you are not eligible to access premium membership yet!']);
        }
    }
}
