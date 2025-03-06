<?php

namespace App\Http\Controllers;

use App\Services\OAuthService;
use Illuminate\Http\Request;

class OAuthController extends Controller
{
    protected $oauthService;

    public function __construct(OAuthService $oauthService)
    {
        $this->oauthService = $oauthService;
    }


    public function index()
    {
        // Check if the access token exists in the session
        $accessToken = session('access_token');

        // If no token exists, try to retrieve a new one
        if (!$accessToken) {
            // Retrieve a new access token
            $accessToken = $this->oauthService->getAccessToken();
            
            if ($accessToken) {
                // Store the token in the session if retrieved successfully
                session(['access_token' => $accessToken]);
            } else {
                // Return an error if the token cannot be retrieved
                return view('landing', [
                    'accessToken' => null,
                    'error' => 'Failed to retrieve access token.'
                ]);
            }
        }

        // Pass the access token to the view
        return view('landing', compact('accessToken'));
    }

    public function authenticate()
    {
        // Check if access token already exists in the session
        if (session()->has('access_token')) {
            return response()->json([
                'success' => false,
                'error' => 'Access token already exists.',
            ], 400);
        }
    
        // Retrieve a new access token
        $accessToken = $this->oauthService->getAccessToken();
    
        // Debugging line to check token
        dd($accessToken);  // This will stop execution and show the value of the access token
    
        if ($accessToken) {
            session(['access_token' => $accessToken]); // Store the token in session
    
            return response()->json([
                'success' => true,
                'access_token' => $accessToken,
            ]);
        }
    
        return response()->json([
            'success' => false,
            'error' => 'Failed to retrieve access token',
        ], 400);
    }
    
}
