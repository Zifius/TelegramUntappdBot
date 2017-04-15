<?php

namespace Untappd\Commands;

use Untappd\Bot\Slugs;

class Search extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    public function execute()
    {
        $response = $this->getClient()->request(
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
    }
}