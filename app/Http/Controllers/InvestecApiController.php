<?php

namespace App\Http\Controllers;

use App\Services\OAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InvestecApiController extends Controller
{
    protected $oauthService;

    public function __construct(OAuthService $oauthService)
    {
        $this->oauthService = $oauthService;
    }

    public function fetchAccountInfo(Request $request)
    {
        // Retrieve the access token from the session
        $bearerToken = session('access_token');

        // If no token exists, try to retrieve a new one
        if (!$bearerToken) {
            // Retrieve a new access token using the OAuthService
            $bearerToken = $this->oauthService->getAccessToken();
            
            // Check if the access token was successfully retrieved
            if ($bearerToken) {
                session(['access_token' => $bearerToken]); // Store the new token in the session
            } else {
                return response()->json([
                    'error' => 'Failed to retrieve access token',
                    'message' => 'Unable to retrieve an access token. Please authenticate first.'
                ], 400);
            }
        }

        // Send a GET request to the Investec API with the access token
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $bearerToken,
        ])->get('https://openapisandbox.investec.com/za/pb/v1/accounts');

        // Check if the request was successful
        if ($response->successful()) {
            return view('account-info', ['data' => $response->json()]);  // Pass the JSON response to the view
        }

        // If the request failed, return an error message
        return response()->json([
            'error' => 'Failed to fetch account information',
            'message' => $response->body(),
        ], 400);
    }
}
