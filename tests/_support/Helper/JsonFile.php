<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 25/10/15
 * Time: 18:41
 */

namespace CubicMushroom\Tools\ProjectToolbelt\Codeception\Helper;

use Codeception\Exception\ConditionalAssertionFailed;
use Codeception\Exception\ModuleRequireException;
use Codeception\Exception\TestRuntimeException;
use Codeception\Lib\ModuleContainer;
use Codeception\Module;

/**
 * Module for testing npm package.json files
 *
 * @package CubicMushroom\Tools\ProjectToolbelt
 */
class JsonFile extends Module
{

    protected $requiredModules = ['Filesystem'];

    const CONFIG_PROJECT_ROOT = 'project_root';

    /**
     * @var
     */
    protected $projectRoot;

    /**
     * @var array
     */
    protected $json;


    /**
     * @param ModuleContainer $moduleContainer
     * @param array           $config
     *
     * @throws ModuleRequireException if required modules are not available
     */
    public function __construct(ModuleContainer $moduleContainer, $config = null)
    {
        parent::__construct($moduleContainer, $config);

        $missingModules = [];
        foreach ($this->requiredModules as $module) {
            if (!$moduleContainer->hasModule($module)) {
                $missingModules[] = $module;
            }
        }

        if (!empty($missingModules)) {
            throw new ModuleRequireException(
                'Missing the following modules, required by the NpmPackage module are missing...',
                implode(', ', $missingModules)
            );
        }

        $this->fs = $moduleContainer->getModule('Filesystem');
    }


    /**
     * @param string $path
     */
    public function openPackageJsonFile($path = null)
    {
        if (is_null($path)) {
            $path = $this->_getConfig(self::CONFIG_PROJECT_ROOT);
        }

        if (empty($path)) {
            throw new TestRuntimeException(
                'You must either configure the \''.self::CONFIG_PROJECT_ROOT.'\' provide the $path or provide the $path'
            );
        }

        $this->json = json_decode(file_get_contents("{$path}/package.json"), true);
    }


    /**
     * @param string $path
     * @param mixed  $expected
     */
    public function assertPackageJsonValue($path, $expected)
    {
        $pathParts = explode('.', $path);

        $actual = $this->json;
        do {
            $pathPart = array_shift($pathParts);
            if (!isset($actual[$pathPart])) {
                throw new ConditionalAssertionFailed("Item at {$path} not found");
            }
            $actual = $actual[$pathPart];
        } while (count($pathParts) > 0);

        if ($expected !== $actual) {
            if (!is_scalar($actual)) {
                $actual = var_export($actual, true);
            }
            throw new ConditionalAssertionFailed(
                "Value '{$actual}' at {$path} does not match the expected value of '{$expected}'"
            );
        }
    }


    /**
     * @param string $path
     */
    public function assertPackageJsonPathExists($path)
    {
        $pathParts = explode('.', $path);

        $actual = $this->json;
        do {
            $pathPart = array_shift($pathParts);
            if (!isset($actual[$pathPart])) {
                throw new ConditionalAssertionFailed("Item at {$path} not found");
            }
            $actual = $actual[$pathPart];
        } while (count($pathParts) > 0);
    }
}