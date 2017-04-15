<?php

namespace Untappd\Bot;

require_once 'vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use TelegramBot\Api\Client;
use TelegramBot\Api\Exception;

$dotEnv = new Dotenv();
$dotEnv->load(__DIR__.'/.env');

// Send request
try {

    $bot = new Client(getenv('API_TOKEN'));

    $bot->command('beer', function ($message) use ($bot) {
        $bot->sendMessage($message->getChat()->getId(), 'pong!');
    });

    $bot->run();

} catch (Exception $e) {
    echo $e->getMessage();
    print_r($e->getTraceAsString());
}
