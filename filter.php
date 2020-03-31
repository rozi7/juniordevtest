<?php

// URL
if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||  isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') $protocol = 'https://';
else $protocol = 'http://';
$current_url = "{$protocol}{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
//echo substr($current_url,7,2);
if($_SERVER['HTTP_HOST'] == 'localhost'){
    $base = $app->config->base_url;
}
if(strpos($current_url, $base) !== 0) exit('Error: Base URL not match');


// Routing
$group_rules = [
    'public' => function($route, $app) { return true; }
];

$method = strtolower($_SERVER['REQUEST_METHOD']);
if($app->input->post('_method')) $method = strtolower($app->input->post('_method'));
elseif($app->input->get('_method')) $method = strtolower($app->input->get('_method'));

$path = str_replace($base, '', $current_url);
$path = str_replace('?' . $_SERVER['QUERY_STRING'], '', $path);
$route = "{$method}:{$path}";


$raw_routing = require 'routing.php';

$found = false;
foreach($raw_routing as $group => $routing) {
    if(isset($routing[$route])) {
        $found = true;

        if(!$group_rules[$group]($route, $app)) unauthorized();

        $page = $routing[$route];

        $file = $sysdir . '/pages/' . $page . '.php';
        if(!file_exists($file)) notfound();
        require $file;
    }
}

if(!$found) notfound();