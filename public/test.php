<?php

use Telegram\Bot\BotsManager;

$config = include '../config.php';

$telegram = new BotsManager($config);

# Or if you are supplying a self-signed-certificate
$response = $telegram->bot('mybot')->

var_dump($response);
