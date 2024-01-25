<?php

use Telegram\Bot\BotsManager;

$config = include '../config.php';

$telegram = new BotsManager($config);

// Example usage
$response = $telegram->bot('mybot')->getMe();

var_dump($response);
