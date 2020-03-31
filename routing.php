<?php

return [
    'public' => [
        'get:/' => 'register',
        'get:/register' => 'register',
        'get:/login' => 'register',
        'get:/home' => 'register',

        'post:/login' => 'actions/auth/login',
        'post:/register' => 'register',

        'get:/product' => 'product',
        'get:/sales' => 'sales',
        'get:/sales_list' => 'sales_list',
    ],
];