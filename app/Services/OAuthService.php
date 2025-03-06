<?php

namespace App\Services;

use GuzzleHttp\Client;

class OAuthService
{
    private $clientId;
    private $clientSecret;
    private $apiKey;
    private $tokenUrl;

    public function __construct()
    {
        $this->clientId = env('INVESTEC_CLIENT_ID');
        $this->clientSecret = env('INVESTEC_CLIENT_SECRET');
        $this->apiKey = env('INVESTEC_API_KEY');
        $this->tokenUrl = env('INVESTEC_TOKEN_URL');
    }

    public function getAccessToken()
    {
        $client = new Client();

        $authHeader = base64_encode("{$this->clientId}:{$this->clientSecret}");

        try {
            $response = $client->post($this->tokenUrl, [
                'headers' => [
                    'Authorization' => "Basic $authHeader",
                    'x-api-key' => $this->apiKey,
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data['access_token'] ?? null;

        } catch (\Exception $e) {
            return null;
        }
    }
}
