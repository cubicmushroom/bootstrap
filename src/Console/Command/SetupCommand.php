<?php

namespace CubicMushroom\Tools\ProjectToolbelt\Console\Command;

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
    const NAME        = 'setup';
    const DESCRIPTION = 'Sets up the toolbelt for the given project';

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this
            ->setName(Command::NAME.':'.self::NAME)
            ->setDescription(self::DESCRIPTION)
            ->addArgument('path', InputArgument::OPTIONAL, 'Project path');
    }
}
