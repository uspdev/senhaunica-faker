<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $oauth_token = '';
        $callback_id = '';
        $referer = 'http://localhost:8001/';
        $disabled = 'disabled';
        return view('index', compact('oauth_token','callback_id', 'referer', 'disabled'));
    }
}
