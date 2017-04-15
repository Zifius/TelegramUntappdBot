<?php

namespace Untappd\Bot;

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\Dotenv\Dotenv;

$dotEnv = new Dotenv();
$dotEnv->load(__DIR__.'/.env');

// Create HTTP Client
$client = new Client(['base_uri' => Api::ENDPOINT]);

// Send request
try {
    $response = $client->request(
        'GET',
        Slugs\Search::BEER,
        [
            'query' => [
                'client_id' => getenv('CLIENT_ID'),
                'client_secret' => getenv('CLIENT_SECRET'),
                'q' => 'Augustiner'
            ]
        ]
    );

    if ($response->getStatusCode() == 200) {
        $responseBody = \GuzzleHttp\json_decode($response->getBody(), true);

        foreach ($responseBody['response']['beers']['items'] as $beer) {
            echo sprintf("%s (%s), enjoyed \e[0;32m%d\e[m time(s)\n", $beer['beer']['beer_name'], $beer['beer']['beer_style'], $beer['checkin_count']);
            
        }
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
