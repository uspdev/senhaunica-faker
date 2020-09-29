<?php

namespace App\Utils;

class OAuthUtils
{
    public static function parseAuthorization($oauth_string) {
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
}
