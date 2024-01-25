<?php

use Telegram\Bot\Api;
use Telegram\Bot\BotsManager;
use Telegram\Bot\Objects\Update;

$config = include '../config.php';

$telegram = new BotsManager($config);

// Example usage
$update = $telegram->bot('mybot')->commandsHandler(true);


if ($update->isType('callback_query')) {
    
}

file_put_contents('../logs/webhook.log', print_r($update, true), FILE_APPEND);

$post = file_get_contents('php://input');
file_put_contents('../logs/webhook.log', "POST\n" . $post, FILE_APPEND);

