<?php

use Telegram\Bot\BotsManager;

$config = include '../config.php';

$telegram = new BotsManager($config);

// Example usage
$update = $telegram->commandsHandler(true);

var_dump($update);
