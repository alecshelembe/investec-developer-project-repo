<?php

namespace App\Http\Controllers;

use App\Services\OAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OAuthController extends Controller
{
    protected $oauthService;

    public function __construct(OAuthService $oauthService)
    {
        $this->oauthService = $oauthService;
    }

    // Helper method to get or retrieve access token
    protected function getAccessTokenOrRedirect()
    {
        // Check if access token exists in the session
        $accessToken = session('access_token');
        
        // If no token exists, retrieve it using the OAuthService
        if (!$accessToken) {
            $accessToken = $this->oauthService->getAccessToken();

            // If token retrieval fails, return error
            if (!$accessToken) {
                return null;  // Indicating failure to retrieve access token
            }

            // Store the token in the session
            session(['access_token' => $accessToken]);
        }

        return $accessToken;
    }

    public function index()
    {
        // Attempt to retrieve the access token
        $accessToken = $this->getAccessTokenOrRedirect();

        // If no token exists, return an error message to the view
        if (!$accessToken) {
            return view('landing', [
                'error' => 'Failed to retrieve access token. Please authenticate.'
            ]);
        }

        // Return the landing view with the access token
        return view('landing', compact('accessToken'));
    }

  public function fetchAccountInfo()
    {
        // Retrieve the access token
        $accessToken = $this->getAccessTokenOrRedirect();

        // If no token exists, return an error message to the view
        if (!$accessToken) {
            return view('landing', [
                'error' => 'Access token not found. Please authenticate first.'
            ]);
        }

        // Make the API request using the access token
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get('https://openapisandbox.investec.com/za/pb/v1/accounts');

         // Check if the request was successful
        if ($response->successful()) {
            // Get the JSON response
            $accountData = $response->json();

            // dd($accountData);
            // Debug: Log the response to see the structure
            // Log::info('Account Data:', $accountData);

            // Pass the account data to the view
            return view('account-info', [
                'accountData' => $accountData, // Pass the account data to the view
            ]);

        }

        // If the request failed, return an error message to the view
        return response()->json([
            'susccess' => false,
            'error' => 'Failed to fetch account information from Investec.',
        ], 400);
    }  

    public function authenticate()
    {
        // Check if the access token already exists
        if (session()->has('access_token')) {
            return response()->json([
                'success' => false,
                'error' => 'Access token already exists.',
            ], 400);
        }

        // Retrieve a new access token using the OAuthService
        $accessToken = $this->oauthService->getAccessToken();

        // If no access token is retrieved, return an error
        if (!$accessToken) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to retrieve access token.',
            ], 400);
        }

        // Store the token in the session
        session(['access_token' => $accessToken]);

        // Return the access token in the response
        return response()->json([
            'success' => true,
            'access_token' => $accessToken,
        ]);
    }

    public function fetchAccountBalance($accountId)
{
    // Retrieve the access token
    $accessToken = $this->getAccessTokenOrRedirect();

    if (!$accessToken) {
        return view('landing', [
            'error' => 'Access token not found. Please authenticate first.'
        ]);
    }

    // Make API request
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
    ])->get("https://openapisandbox.investec.com/za/pb/v1/accounts/{$accountId}/balance");

    if ($response->successful()) {
        $balanceData = $response->json();

        if (!isset($balanceData['data'])) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid response from Investec API.',
            ], 500);
        }

        return view('account-balance', [
            'balance' => $balanceData['data'],
        ]);
    }

    return response()->json([
        'success' => false,
        'error-text' => $response,
        'error' => 'Failed to fetch account balance from Investec.',
    ], $response->status());
}

}
