<?php

namespace spec\CubicMushroom\Tools\ProjectToolbelt\Console\Command;

use CubicMushroom\Tools\ProjectToolbelt\Console\Command\SetupCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Command\Command;

/**
 * Class SetupCommandSpec
 *
 * @package CubicMushroom\Tools\ProjectToolbelt
 */
class SetupCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SetupCommand::class);
    }


    function it_should_be_a_console_command()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->shouldBeAnInstanceOf(Command::class);
    }


    // See PHPUnit for more tests
}
