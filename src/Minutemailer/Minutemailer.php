<?php namespace Minutemailer;

class Minutemailer
{
    private $baseUrl;
    private $clientSecret;
    protected $client;

    public function __construct($personalAccessToken)
    {
        $this->baseUrl = 'https://api-gateway.minutemailer.com';
        $this->clientSecret = $personalAccessToken;
        if (class_exists('Guzzle\\Common\\Version')) {
            $this->client = new \Guzzle\Http\Client($this->baseUrl, array(
                'request.options' => array(
                    'headers' => array(
                        'Accept' => 'application/json',
                        'X-Auth-Token' => $this->clientSecret,
                    ),
                ),
            ));
        }
        else {
            $this->client = new \GuzzleHttp\Client(array(
                'base_uri' => $this->baseUrl . '/',
                'headers' => array(
                    'Accept' => 'application/json',
                    'X-Auth-Token' => $this->clientSecret,
                ),
            ));
        }
    }

    /**
     * @param string $id field UUID
     */
    public function fields($id = null)
    {
        return new Fields($this->client, $id);
    }

    /**
     * @param string $id contact UUID
     */
    public function contacts($id = null)
    {
        return new Contacts($this->client, $id);
    }

    /**
     * @param string $id contactlist UUID
     */
    public function contact_lists($id = null)
    {
        return new ContactLists($this->client, $id);
    }

}
