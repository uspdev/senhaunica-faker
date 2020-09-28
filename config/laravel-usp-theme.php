<?php

return [
    'title' => config('app.name'),
    'dashboard_url' => config('app.url'),
    'logout_method' => 'POST',
    'logout_url' => config('app.url') . '/',
    'login_url' => config('app.url') . '/',
    'menu' => [],
    'right_menu' => []
];
