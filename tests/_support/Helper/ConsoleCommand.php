<?php
namespace CubicMushroom\Tools\ProjectToolbelt\Codeception\Helper;

    // here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Module;
use CubicMushroom\Tools\ProjectToolbelt\Console\Command\BootstrapCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ConsoleCommand extends Module
{
    const CONFIG_TEST_PATH = 'test_path';

    /**
     * @var array
     */
    protected $requiredFields = [self::CONFIG_TEST_PATH];

    /**
     * @var CommandTester
     */
    protected $commandTester;

    /**
     * @var Application
     */
    protected $application;


    /**
     * Prepares the
     */
    public function _initialize()
    {
        $this->application = new Application();
        $this->application->add(new BootstrapCommand());
    }


    /**
     * @param string $command
     * @param array  $args
     */
    public function runTheCommand($command, array $args = [])
    {
        $command = $this->application->find($command);

        $testArguments = array_merge($args, ['command' => $command->getName()]);

        $this->commandTester = new CommandTester($command);
        $this->commandTester->execute($testArguments);
    }


    /**
     * Asserts that the output contains the give regex
     *
     * @param $regex
     */
    public function seeOutput($regex)
    {
        if (empty($this->commandTester)) {
            throw new \RuntimeException('You need to call runTheCommand() before checking the output');
        }

        $this->assertRegExp('/'.preg_quote($regex, '/').'/', $this->commandTester->getDisplay());
    }
}
