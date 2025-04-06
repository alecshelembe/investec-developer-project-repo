<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Services\OAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ApiAuthController extends Controller
{
    protected $oauthService;

    public function __construct(OAuthService $oauthService)
    {
        $this->oauthService = $oauthService;
    }

    public function fetchAccountBalance(Request $request)
    {
        $accountId = $request->input('accountId');
        $accessToken = $request->input('access_token');

        if (!$accessToken) {
            return response()->json(['error' => 'The Access token is required.'], 400);
        }

        // Make API request
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get("https://openapisandbox.investec.com/za/pb/v1/accounts/{$accountId}/balance");

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'balance' => $response->json(),
            ]);
            
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Failed to fetch account balance.',
            ], 500);
        }   

    }

    public function fetchAccountInfo(Request $request)
    {
        try {

            $accessToken = $request->input('access_token');

            if (!$accessToken) {
                return response()->json(['error' => 'Access token is required.'], 400);
            }
        
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get('https://openapisandbox.investec.com/za/pb/v1/accounts');
        
            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'accountData' => $response->json(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching account information: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Server Error',
                'message' => 'Something went wrong while fetching account information.',
            ], 500);
        }
    }

    public function authenticate(Request $request)
    {
        try {
            $accessToken = $this->oauthService->getAccessToken();

            if ($accessToken) {
                return response()->json([
                    'access_token' => $accessToken
                ]);
            }

            return response()->json([
                'error' => 'Authentication failed',
                'message' => 'Unable to retrieve access token.'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
