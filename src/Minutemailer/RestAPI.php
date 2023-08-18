<?php

namespace Minutemailer;

class RestAPI
{
    /**
     * @var string
     */
    public $endpoint;
    /**
     * @var object
     */
    public $client;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $segment;

    /**
     * @param object $client
     * @param string $id
     */
    public function __construct($client, $id = '')
    {
        $this->client = $client;
        $this->id = $id;
    }

    protected function getEndpoint()
    {
        $endpoint = $this->endpoint;

        if (strlen($this->id) > 0) {
            $endpoint .= '/' . $this->id;
        }

        if (strlen($this->segment) > 0) {
            $endpoint .= '/' . $this->segment;
        }

        return $endpoint;
    }

    /**
     * Get resource
     * @param  array  $query
     * @return mixed
     */
    public function get($query = array())
    {
        $endpoint = $this->getEndpoint();

        $response = $this->client->get($endpoint, array('query' => $query));
        $response = json_decode($response->getBody());

        return $response;
    }

    /**
     * Post data
     * @param  array  $data
     * @return mixed
     */
    public function post($data = array())
    {
        $endpoint = $this->getEndpoint();

        $response = $this->client->post($endpoint, array('json' => $data));
        $response = json_decode($response->getBody());

        return $response;
    }

    /**
     * Delete data
     * @param  array  $data
     * @return mixed
     */
    public function delete($data = array())
    {
        $endpoint = $this->getEndpoint();

        $response = $this->client->delete($endpoint, array('json' => $data));
        $response = json_decode($response->getBody());

        return $response;
    }

    /**
     * @param  mixed  $data
     * @return mixed
     */
    public function put($data = array())
    {
        $endpoint = $this->getEndpoint();

        $response = $this->client->put($endpoint, array('json' => $data));
        $response = json_decode($response->getBody());

        return $response;
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    public function getWithBody($data = array())
    {
        $endpoint = $this->getEndpoint();

        $response = $this->client->request('get', $endpoint, array('json' => $data));
        $response = json_decode($response->getBody());

        return $response;
    }

    /**
     * @param  string  $method
     * @param  string  $replacedBy
     * @return void
     */
    protected function deprecated($method, $replacedBy)
    {
        trigger_error($method.' is replaced by '.$replacedBy, E_USER_DEPRECATED);
    }
}
