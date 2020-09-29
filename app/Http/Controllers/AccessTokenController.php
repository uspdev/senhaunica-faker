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

        # o verifier vem via URL ou via HTTP body
        if (isset($request->oauth_verifier)) {
            $verifier = $request->oauth_verifier;
        }
        else {
            $oauth = OAuthUtils::parseAuthorization($oauth_string);
            $verifier = $oauth['oauth_verifier'];
        }
        $token = [
            'oauth_token' => $verifier,
            'oauth_token_secret' => Str::random()
        ];
        return OAuthUtils::format($token);
    }   
}
