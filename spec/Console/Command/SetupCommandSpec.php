<?php

namespace spec\CubicMushroom\Tools\ProjectToolbelt\Console\Command;

use CubicMushroom\Tools\ProjectToolbelt\Console\Command\SetupCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SetupCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SetupCommand::class);
    }
}
