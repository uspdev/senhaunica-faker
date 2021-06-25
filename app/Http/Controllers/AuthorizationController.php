<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    public function authorise(Request $request)
    {
        $request->validate([
            'oauth_token' => 'required',
            'loginUsuario' => 'required|numeric',
            'callback_id' => 'nullable',
            'callback' => 'required',
        ]);

        $oauth_token = $request->oauth_token;
        $oauth_verifier = $request->loginUsuario;
        $callback_id = $request->callback_id;
        $callback = $request->callback;
        $data = $callback . '?oauth_token=' . $oauth_token . '&oauth_verifier=' . $oauth_verifier . '&callback_id=' . $callback_id;
        return redirect($data);
    }

    public function index(Request $request)
    {
        $oauth_token = $request->oauth_token;
        $callback_id = $request->callback_id;
        $referer = $request->headers->get('referer');
        $disabled = '';
        return view('index', compact('oauth_token', 'callback_id', 'referer', 'disabled'));
    }
}
