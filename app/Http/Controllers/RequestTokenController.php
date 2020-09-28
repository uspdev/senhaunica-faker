<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class RequestTokenController extends Controller
{
    public function createToken()
    {
        $token = [
            'oauth_token' => Str::random(),
            'oauth_token_secret' => Str::random()
        ];
        return response()->json($token);
    }   
}
