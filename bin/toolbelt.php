#!/usr/bin/env php
<?php

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

// If you customise you're vendor directory, create your own script file that calls this file, but defines the
// COMPOSER_VENDOR_DIR constant to be the correct vendor direc
if (!defined('COMPOSER_VENDOR_DIR')) {
    define('COMPOSER_VENDOR_DIR', dirname(dirname(dirname(__FILE__))).DS.'vendor');
}

/** @noinspection PhpIncludeInspection */
require_once COMPOSER_VENDOR_DIR.'/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();
$application->run();