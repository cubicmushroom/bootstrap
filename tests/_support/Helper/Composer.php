<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 25/10/15
 * Time: 17:27
 */

namespace CubicMushroom\Tools\ProjectToolbelt\Codeception\Helper;

use Codeception\Module;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class Composer
 *
 * @package CubicMushroom\Tools\ProjectToolbelt\Codeception\Helper
 */
class Composer extends Module
{

    /**
     * Creates the test composer.json file in the given path
     *
     * @param string $path
     */
    public function haveInitialisedComposerIn($path)
    {
        $realPath = realpath($path);
        if (false === $realPath) {
            throw new \RuntimeException("Path $path does not exist");
        }

        $fs = new Filesystem();
        $fs->dumpFile(
            "{$path}/composer.json",
            json_encode(
                [
                    'name' => 'cubicmushroom/test-project',
                    'version' => '0.0.0'
                ]
            )
        );
    }
}