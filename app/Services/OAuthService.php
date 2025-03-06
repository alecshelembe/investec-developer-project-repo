<?php

namespace App\Services;

use GuzzleHttp\Client;

class OAuthService
{
    private $clientId = 'yAxzQRFX97vOcyQAwluEU6H6ePxMA5eY';
    private $clientSecret = '4dY0PjEYqoBrZ99r';
    private $apiKey = 'your-x-api-key'; // Replace with actual x-api-key
    private $tokenUrl = 'https://openapisandbox.investec.com/identity/v2/oauth2/token';

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
