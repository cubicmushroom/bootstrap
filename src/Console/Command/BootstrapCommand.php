<?php

namespace CubicMushroom\Tools\ProjectToolbelt\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class BootstrapCommand
 *
 * @package CubicMushroom\Tools\ProjectToolbelt
 *
 * @see     \spec\CubicMushroom\Tools\ProjectToolbelt\Console\Command\BootstrapCommandSpec for spec
 */
class BootstrapCommand extends Command
{
    const NAME        = 'bootstrap';
    const DESCRIPTION = 'Sets up the toolbelt for the given project';
    const BINARY_FILE = 'toolbelt';

    const ERROR_CODE_PATH_DOES_NOT_EXISTS = 1;


    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this
            ->setName(self::NAME)
            ->setDescription(self::DESCRIPTION)
            ->addArgument('path', InputArgument::OPTIONAL, 'Project path', getcwd());
    }


    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code
     *
     * @throws \LogicException When this abstract method is not implemented
     *
     * @see setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path     = $input->getArgument('path');
        $realPath = realpath($path);

        if (false === $path) {
            // @todo - Add test for this error
            $output->writeln("<error>Path $path does not exist</error>");

            return self::ERROR_CODE_PATH_DOES_NOT_EXISTS;
        }

        $output->writeln('<info>Bootstrapping project in '.realpath($path).'</info>');

        $fs = new Filesystem();

        $output->writeln('<info>Creating package.json file</info>');
        $fs->touch("{$path}/package.json");


//        $output->writeln('<info>Creating gulpfile.js</info>');

//        $fs->touch("$path/gulpfile.js");
    }


}
