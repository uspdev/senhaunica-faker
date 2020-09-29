<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Utils\OAuthUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccessTokenController extends Controller
{
    public function createToken(Request $request)
    {
        $oauth_string = $request->header('Authorization');
        $oauth = OAuthUtils::parseAuthorization($oauth_string);
        $token = [
            'oauth_token' => $oauth['oauth_verifier'],
            'oauth_token_secret' => Str::random()
        ];
        return response()->json($token);
    }   
}
