<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 25/10/15
 * Time: 18:10
 */

namespace CubicMushroom\Tools\ProjectToolbelt\Codeception\Helper;

use Codeception\Lib\ModuleContainer;
use Codeception\Module;
use Codeception\Module\Filesystem;
use Codeception\TestCase;

/**
 * Class Functional
 *
 * @package CubicMushroom\Tools\ProjectToolbelt
 */
class Functional extends Module
{
    /**
     * Array of required config keys
     *
     * @var array
     */
    protected $requiredFields = ['test_path'];

    /**
     * @var Filesystem
     */
    protected $fs;

    /**
     * Directory to use for the root of the test project
     *
     * @var string
     */
    private $projectRoot;

    /**
     * Project directory template path
     *
     * @var string
     */
    protected $projectDirTemplate;


    /**
     * @param ModuleContainer $moduleContainer
     * @param null            $config
     */
    public function __construct(ModuleContainer $moduleContainer, $config = null)
    {
        parent::__construct($moduleContainer, $config);

        $this->fs = $this->getModule('Filesystem');

        $packageDir               = dirname(dirname(dirname(dirname(__FILE__))));
        $this->projectDirTemplate = "$packageDir/tests/_data/project_template";

        $this->projectRoot = "{$packageDir}/{$config['test_path']}";

        // Set the project root for the NpmPackage module
        if ($moduleContainer->hasModule('\CubicMushroom\Tools\ProjectToolbelt\Codeception\Helper\NpmPackage')) {
            /** @var JsonFile $npmPackageModule */
            $npmPackageModule = $moduleContainer->getModule(
                '\CubicMushroom\Tools\ProjectToolbelt\Codeception\Helper\NpmPackage'
            );
            $npmPackageModule->_reconfigure([JsonFile::CONFIG_PROJECT_ROOT => $this->projectRoot]);
        }
    }


    public function _before(TestCase $test)
    {
        $this->fs->deleteDir($this->projectRoot);
        $this->fs->copyDir($this->projectDirTemplate, $this->projectRoot);
    }


    public function _after(TestCase $test)
    {
        $this->fs->deleteDir($this->projectRoot);
    }


    public function getTheProjectTestRoot()
    {
        return $this->projectRoot;
    }


    public function haveInitialisedComposer()
    {
        $this->fs->seeFileFound('composer.json', $this->projectRoot);
    }
}