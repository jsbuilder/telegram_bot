<?php

use Telegram\Bot\BotsManager;
use Telegram\Bot\Keyboard\Keyboard;

$config = include '../config.php';

$telegram = new BotsManager($config);

// Example usage
$response = $telegram->bot('mybot')->getMe();

var_dump($response);
