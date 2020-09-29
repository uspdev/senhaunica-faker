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
        $callback = $request->callback;
        $data = $callback.'?oauth_token='.$oauth_token.'&oauth_verifier='.$oauth_verifier.'&callback_id='.$callback_id;
        return redirect($data);
    }

    public function index(Request $request)
    {
        $oauth_token = $request->oauth_token;
        $callback_id = $request->callback_id;
        return view('authorize.index', compact('oauth_token','callback_id'));
    }
}
