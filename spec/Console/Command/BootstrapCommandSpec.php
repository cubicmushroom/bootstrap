<?php

namespace spec\CubicMushroom\Tools\ProjectToolbelt\Console\Command;

use CubicMushroom\Tools\ProjectToolbelt\Console\Command\BootstrapCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

/**
 * Class BootstrapCommandSpec
 *
 * @package CubicMushroom\Tools\ProjectToolbelt
 */
class BootstrapCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BootstrapCommand::class);
    }


    function it_should_be_a_console_command()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->shouldBeAnInstanceOf(SymfonyCommand::class);
    }


    function it_should_be_configured_correctly()
    {
        /** @var self|BootstrapCommand $this */

        /** @noinspection PhpUndefinedMethodInspection */
        $this->getName()->shouldReturn(BootstrapCommand::NAME);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->getDescription()->shouldBeString();
        /** @noinspection PhpUndefinedMethodInspection */
        $this->getDescription()->shouldNotReturn('');
        /** @noinspection PhpUndefinedMethodInspection */
        $this->getDescription()->shouldReturn(BootstrapCommand::DESCRIPTION);
    }


    // See PHPUnit for more tests
}
