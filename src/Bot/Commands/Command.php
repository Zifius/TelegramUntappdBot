<?php

namespace Untappd\Commands;

use GuzzleHttp\Client as HttpClient;
use Untappd\Bot\Api;

class Command
{
    /** @var HttpClient */
    private $httpClient;

    public function __construct()
    {
        // Create HTTP Client
        $this->httpClient = new HttpClient(['base_uri' => Api::ENDPOINT]);
    }

    /**
     * @return HttpClient
     */
    public function getClient()
    {
        return $this->httpClient;
    }
}