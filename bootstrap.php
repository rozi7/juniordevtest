<?php

define('MB', 1048576);

$sysdir = __DIR__;

require 'vendor/autoload.php';

// main object for application
$app = new \App\Application(require 'config.php');

session_start();

require 'helpers.php';
require 'filter.php';