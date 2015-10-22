<?php

namespace spec\CubicMushroom\Tools\ProjectToolbelt\Console\Command;

use CubicMushroom\Tools\ProjectToolbelt\Console\Command\Command;
use CubicMushroom\Tools\ProjectToolbelt\Console\Command\SetupCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

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
        $this->shouldBeAnInstanceOf(SymfonyCommand::class);
    }


    function it_should_be_configured_correctly()
    {
        /** @var self|SetupCommand $this */

        /** @noinspection PhpUndefinedMethodInspection */
        $this->getName()->shouldReturn(Command::NAME.':setup');

        /** @noinspection PhpUndefinedMethodInspection */
        $this->getDescription()->shouldBeString();
        /** @noinspection PhpUndefinedMethodInspection */
        $this->getDescription()->shouldNotReturn('');
        /** @noinspection PhpUndefinedMethodInspection */
        $this->getDescription()->shouldReturn(SetupCommand::DESCRIPTION);
    }


    // See PHPUnit for more tests
}
