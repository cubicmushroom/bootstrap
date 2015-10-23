<?php
// This is global bootstrap for autoloading

use Symfony\Component\Filesystem\Filesystem;

$fs = new Filesystem();

$testBinDir = __DIR__.'/_output/app_root/bin';
if (!$fs->exists($testBinDir)) {
    $fs->mkdir($testBinDir);
}

define('TOOLBELT_BIN', realpath($testBinDir));