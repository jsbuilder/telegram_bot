<?php

use Telegram\Bot\BotsManager;

$config = include '../config.php';

$telegram = new BotsManager($config);

# Or if you are supplying a self-signed-certificate
$response = $telegram->bot('mybot')->setWebhook([
                                      'url' => 'https://kravnet.asuscomm.com:88/webhook.php',
                                      'certificate' => __DIR__ . '/nginx-selfsigned.crt'
                                  ]);
var_dump($response);

