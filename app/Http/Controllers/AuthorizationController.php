<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    public function authorise(Request $request)
    {
        $oauth_token = $request->oauth_token;
        $oauth_verifier = $request->loginUsuario;
        $callback_id = $request->callback_id;
        $data = [
            'oauth_token' => $oauth_token,
            'oauth_verifier' => $oauth_verifier,
            'callback_id' => $callback_id
        ];
        $data = '/?oauth_token='.$oauth_token.'&oauth_verifier='.$oauth_verifier.'&callback_id='.$callback_id;
        return redirect($data);
    }   
}