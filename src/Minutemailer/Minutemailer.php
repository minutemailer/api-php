<?php namespace Minutemailer;

use \GuzzleHttp\Client;

class Minutemailer
{

	private $baseUrl;
	private $urlAccessToken;
	private $grantType;
	private $currentEndpoint;
	private $version;
	private $clientSecret;
	private $clientId;
	private $client;

	public function __construct($clientId, $clientSecret)
	{
		$this->baseUrl        = 'https://api.minutemailer.com';
		$this->urlAccessToken = '/oauth/access_token';
		$this->version        = 'v1';
		$this->grantType      = 'password';
		$this->clientId       = $clientId;
		$this->clientSecret   = $clientSecret;
		$this->client         = new Client(['base_uri' => $this->baseUrl]);

		$this->getAccessToken();
	}

	public function getAccessToken()
	{
		$response = $this->client->post($this->urlAccessToken, ['form_params' => [
			'grant_type'    => $this->grantType,
			'client_id'     => $this->clientId,
			'client_secret' => $this->clientSecret
		]]);

		if ($response->getBody()) {
			$json = json_decode($response->getBody());
			
			$this->accessToken = $json->access_token;
		}
	}
	
	public function contactLists($token = null)
	{
		$this->currentEndpoint = '/contactlists';
		
		if ($token) {
			$this->currentEndpoint += '/' . $token;
		}
		
		return $this;
	}

	public function subscribe($token)
	{
		$this->currentEndpoint = '/subscribe/' . $token;
		return $this;
	}
	
	public function get($query = [])
	{
		$response = $this->client->get('/' . $this->version . $this->currentEndpoint, ['query' => $query]);
		$response = json_decode($response->getBody());

		return $response;
	}

	public function post($data)
	{
		$data['access_token'] = $this->accessToken;

		$response = $this->client->post('/' . $this->version . $this->currentEndpoint, ['form_params' => $data]);
		$response = json_decode($response->getBody());

		return $response;
	}

}
