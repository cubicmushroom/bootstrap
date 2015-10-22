<?php
namespace CubicMushroom\Tools\ProjectToolbelt\Codeception\Console\Command;

use CubicMushroom\Tools\ProjectToolbelt\Console\Command\SetupCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class SetupCommandTest
 *
 * @package CubicMushroom\Tools\ProjectToolbelt
 */
class SetupCommandTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }


    protected function tearDown()
    {
    }


    /**
     * Tests that the command outputs the expected text
     */
    public function testExpectedOutput()
    {
        $application = new Application();
        $application->add(new SetupCommand());

        $command = $application->find('toolbelt:setup');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $this->assertRegExp('/Hello world/', $commandTester->getDisplay());
    }
}
