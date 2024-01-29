<?php

namespace App\Telegram\Commands;

use App\Telegram\Menu\MainMenuButtonInterface;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Mail\Sender;
use Telegram\Bot\Keyboard\Keyboard;

/**
 * This command can be triggered in two ways:
 * /start and /join due to the alias.
 */
class FindPartCommand extends Command implements MainMenuButtonInterface
{

    protected string $name = 'find_part';

    protected string $description = 'Подобрать запчасть';

    public function handle()
    {
        $message = $this->getUpdate()->getMessage();
        # This will update the chat status to "typing..."
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $btn = Keyboard::button([
                                                          'text' => 'Share my phone number',
                                                          'request_contact' => true,
                                                          'callback_data' => 'request_contact'
                                                      ]);
        $keyboard = Keyboard::make([
                                                             'keyboard' => [[$btn]],
                                                             'resize_keyboard' => true,
                                                             'one_time_keyboard' => true,
                                                         ]);
        

        $this->replyWithMessage(
            [
                'text' => "Введите номер телефона в формате 89990009999 без пробелов и дефисов.\n"
                    . "Вам перезвонит наш специалист для подбора запчастей.\n"
                    . "Мы не передаём номер третьим лицам",
                'reply_markup' => $keyboard
            ]
        );

        // $sender = new Sender();
        // $sender->send('aaaaa');

    }
}
