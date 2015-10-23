<?php
// This is global bootstrap for autoloading

use Symfony\Component\Filesystem\Filesystem;

$fs = new Filesystem();

$appRoot = __DIR__.'/_output/app_root';
if (!$fs->exists($appRoot)) {
    $fs->mkdir($appRoot);
}

define('APP_ROOT', realpath($appRoot));