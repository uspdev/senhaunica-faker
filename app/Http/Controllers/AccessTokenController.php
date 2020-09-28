<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccessTokenController extends Controller
{
    private function parseAuthorization($oauth_string) {
        $tmp = substr($oauth_string, 6);
        $tmp = str_replace("\"", "", $tmp);
        $tmp = explode(", ", $tmp);
        $oauth = [];
        foreach ($tmp as $entry) {
            list($key, $value) = explode("=", $entry, 2);
            $oauth[$key] = $value;
        }
        return $oauth;
    }

    public function createToken(Request $request)
    {
        $oauth_string = $request->header('Authorization');
        $oauth = $this->parseAuthorization($oauth_string);
        $token = [
            'oauth_token' => $oauth['oauth_verifier'],
            'oauth_token_secret' => Str::random()
        ];
        return response()->json($token);
    }   
}
