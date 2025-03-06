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

    public function authenticate()
    {
        $accessToken = $this->oauthService->getAccessToken();
    
        if ($accessToken) {
            session(['access_token' => $accessToken]);
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
