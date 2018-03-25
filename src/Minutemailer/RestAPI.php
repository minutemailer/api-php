<?php

namespace Minutemailer;

class RestAPI
{
    public $endpoint;
    public $client;
    public $id;
    public $segment;

    public function __construct($client, $id = null)
    {
        $this->client = $client;
        $this->id = $id;
    }

    protected function getEndpoint()
    {
        $endpoint = $this->endpoint;

        if ($this->id) {
            $endpoint .= '/' . $this->id;
        }

        if ($this->segment) {
            $endpoint .= '/' . $this->segment;
        }

        return $endpoint;
    }

    /**
     * Get resource
     * @param  array  $query
     * @return GuzzleHttp\Psr7\Response
     */
    public function get($query = [])
    {
        $endpoint = $this->getEndpoint();

        $response = $this->client->get($endpoint, ['query' => $query]);
        $response = json_decode($response->getBody());

        return $response;
    }

    /**
     * Post data
     * @param  array  $data
     * @return GuzzleHttp\Psr7\Response
     */
    public function post($data = [])
    {
        $endpoint = $this->getEndpoint();

        $response = $this->client->post($endpoint, ['form_params' => $data]);
        $response = json_decode($response->getBody());

        return $response;
    }
}
