<?php namespace Minutemailer;

use \GuzzleHttp\Client;

class Minutemailer
{

    private $baseUrl;
    private $currentEndpoint;
    private $version;
    private $clientSecret;
    private $clientId;
    private $client;

    public function __construct($personalAccessToken)
    {
        $this->baseUrl = 'https://api.minutemailer.com';
        $this->version = 'v1';
        $this->personalAccessToken = $personalAccessToken;
        $this->client = new Client([
            'base_uri' => $this->baseUrl . '/' . $this->version . '/',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->personalAccessToken
            ]
        ]);
    }

    public function contact_lists($id)
    {
        return new ContactLists($this->client, $id);
    }

}
