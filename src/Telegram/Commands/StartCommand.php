<?php

namespace App\Telegram\Commands;

use App\Telegram\Menu\Buttons;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

/**
 * This command can be triggered in two ways:
 * /start and /join due to the alias.
 */
class StartCommand extends Command
{

    protected string $name = 'start';

    protected string $description = 'Нажмите СТАРТ.';

    public function handle()
    {
        $message = $this->getUpdate()->getMessage();

        # Get the username argument if the user provides,
        # (optional) fallback to username from Update object as the default.
        $username = $this->argument(
            'username',
            $message->from->first_name . ' ' . $message->from->last_name
        );

        # This will update the chat status to "typing..."
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $buttons  = new Buttons();
        $keyboard = $buttons->getByCommands($this->getTelegram()->getCommands());
        $this->replyWithMessage(
            [
                'text'         =>
                    "Здравствуйте! Я бот AUTO3N.\n"
                    . "Выберите интересующий Вас раздел",
                'reply_markup' => $keyboard
            ]
        );

        // $this->replyWithMessage(['text' => print_r($response, true)]);

        /*        if ($this->argument('age', 0) >= 18) {
                    $this->replyWithMessage(['text' => 'Test bot']);
                } else {
                    $this->replyWithMessage(['text' => 'Test bot']);
                }*/
    }
}
