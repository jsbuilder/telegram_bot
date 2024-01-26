<?php
use Telegram\Bot\BotsManager;


$config = include '../config.php';

$manager = new BotsManager($config);

$telegram = $manager->bot('mybot');

// Example usage
$update = $telegram->commandsHandler(true);

$text_filename = uniqid(rand(), true) . '.log';
file_put_contents('../logs/' . $text_filename, print_r($update, true), FILE_APPEND);

$post_filename = uniqid(rand(), true) . '.json';
$post = file_get_contents('php://input');
file_put_contents('../logs/' . $post_filename, $post);

if ( $update->isType('callback_query') ) {
    $data = $update->callbackQuery->data;
    switch ($data) {
        case 'test_button1':
            $telegram->triggerCommand('test_button1', $update);
            break;
        default: // select month
            $telegram->triggerCommand($data, $update);
    }
}

if ( $update->isType('message') && $update->getMessage()->text !== '/start' ) {
    $data = $update->callbackQuery->data;
    $telegram->triggerCommand('message', $update);
}
