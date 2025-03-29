<?php

namespace App\Http\Controllers;

use App\Services\OAuthService;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    protected $oauthService;

    public function __construct(OAuthService $oauthService)
    {
        $this->oauthService = $oauthService;
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
