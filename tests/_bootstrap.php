<?php
// This is global bootstrap for autoloading

use Symfony\Component\Filesystem\Filesystem;

$fs = new Filesystem();

if (!defined('TEST_ROOT')) {
    define('TEST_ROOT', __DIR__.'/_output/app_root');
}

if (!$fs->exists(TEST_ROOT.'/bin')) {
    $fs->mkdir(TEST_ROOT.'/bin');
}