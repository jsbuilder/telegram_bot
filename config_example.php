<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__.'/vendor/autoload.php';

return [
    'bots' => [
        'mybot' => [
            'token'       => '',
            'webhook_url' => 'https://kravnet.asuscomm.com:88/webhook.php',
            'commands' => [
                App\Telegram\Commands\StartCommand::class,
                App\Telegram\Commands\HelpCommand::class,
                App\Telegram\Commands\TestCommand::class,
                App\Telegram\Commands\TestButton1Command::class,
                App\Telegram\Commands\MessageCommand::class
            ]
        ],
        'default' => 'mybot'
    ],
    'mail' => [
        'host' => 'smtp.yandex.ru',
        'username'=> 'ASASaSA@yandex.ru',
        'password'=> 'ASASaS',
        'mail_to'=> 'ASaSASa@inbox.ru'
    ]
];

