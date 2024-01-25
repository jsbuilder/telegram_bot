<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

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
            $message->from->first_name . ' ' . $message->from->last_name
        );

        $this->replyWithMessage(
            [
                'text' => "Здравствуйте {$username}! {$message->chat->id} Commands:"
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


        # Get all the registered commands.
        $commands = $this->getTelegram()->getCommands();

        $response = '';
        foreach ($commands as $name => $command) {
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }

        $this->replyWithMessage(['text' => $response]);

        $keyboard = Keyboard::make()->inline()
            ->row(
                    [
                    Keyboard::inlineButton(['text' => 'Button 1', 'callback_data' => 'your_callback_data'])
                    ]
            );

        $this->replyWithMessage([
                                    'text' => 'This keyboard feature is awesome!',
                                    'reply_markup' => $keyboard
                                ]);


        // $this->replyWithMessage(['text' => print_r($response, true)]);

        /*        if ($this->argument('age', 0) >= 18) {
                    $this->replyWithMessage(['text' => 'Test bot']);
                } else {
                    $this->replyWithMessage(['text' => 'Test bot']);
                }*/
    }
}
