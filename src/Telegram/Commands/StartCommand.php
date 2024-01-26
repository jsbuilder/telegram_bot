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

        $this->replyWithMessage([
                                    'text' => "Мы имеем данные по Вам\r\n" . print_r($message, true)
                                ]);

        $this->replyWithMessage(
            [
                'text' => "Здравствуйте {$username}! {$message->chat->id} \r\n"

            ]
        );

        # This will update the chat status to "typing..."
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $keyboard = Keyboard::make()->inline()
            ->row(
                    [
                    Keyboard::inlineButton(['text' => 'Button 1', 'callback_data' => 'test_button1'])
                    ]
            );

        $this->replyWithMessage([
                                    'text' => 'Test Button',
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
