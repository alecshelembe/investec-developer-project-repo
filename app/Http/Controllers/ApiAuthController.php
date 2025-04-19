<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Services\OAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\UserLocation;
use Illuminate\Http\JsonResponse; //import JsonResponse


class ApiAuthController extends Controller
{
    protected $oauthService;

    public function __construct(OAuthService $oauthService)
    {
        $this->oauthService = $oauthService;
    }

    public function main_notification(){
        return response()->json([
            'status' => 'main-notification',
            'data' => [
                'title' => 'Join us on the 24 April 2025',
                'message' => "Notification board"
            ]
        ]);
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'timestamp' => 'nullable|date',

                'device_id' => 'nullable|string|max:255',
                'device_name' => 'nullable|string|max:255',
                'platform' => 'nullable|string|max:255',
                'app_version' => 'nullable|string|max:50',
                'expo_push_token' => 'nullable|string|max:255',
            ]);

            // Store the location data
            $location = UserLocation::create([
                'user_id' => auth()->id(), // Optional: only if user is authenticated
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'location_recorded_at' => $validated['timestamp'] ?? now(),
                'device_id' => $validated['device_id'] ?? null,
                'device_name' => $validated['device_name'] ?? null,
                'platform' => $validated['platform'] ?? null,
                'app_version' => $validated['app_version'] ?? null,
                'expo_push_token' => $validated['expo_push_token'] ?? null,
                'last_active_at' => now(),
            ]);

            // Log the success message
            Log::info('Location data saved successfully for user: ' . auth()->id());

            return response()->json([
                'message' => 'Location saved successfully',
                'data' => $location,
            ], 201);

        } catch (\Exception $e) {
            // Log the error
            Log::error('Error storing location data: ' . $e->getMessage(), [
                'user_id' => auth()->id(), // Include user ID for context
                'error' => $e->getTraceAsString() // Log the full stack trace
            ]);

            // Return a user-friendly error message
            return response()->json([
                'message' => 'Failed to save location data. Please try again later.',
            ], 500);
        }
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
