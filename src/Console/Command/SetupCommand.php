<?php

namespace CubicMushroom\Tools\ProjectToolbelt\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class SetupCommand
 *
 * @package CubicMushroom\Tools\ProjectToolbelt
 *
 * @see     \spec\CubicMushroom\Tools\ProjectToolbelt\Console\Command\SetupCommandSpec for spec
 */
class SetupCommand extends Command
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this
            ->setName('setup')
            ->setDescription('Sets up the toolbelt for the given project')
            ->addArgument('path', InputArgument::OPTIONAL, 'Project path');
    }
}
