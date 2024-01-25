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
                App\Telegram\Commands\StartCommand::class
            ]
        ],
        'default' => 'mybot'
    ]
];

