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

    const ERROR_CODE_PATH_DOES_NOT_EXISTS       = 1;
    const ERROR_CODE_COMPOSER_JSON_FILE_MISSING = 2;
    const ERROR_CODE_COMPOSER_JSON_DATA_MISSING = 3;
    const ERROR_CODE_NPM_INSTALL_FAILED         = 4;


    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this
            ->setName(self::NAME)
            ->setDescription(self::DESCRIPTION)
            ->addArgument('path', InputArgument::REQUIRED, 'Project directory');
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
        $fs = new Filesystem();

        $path     = $input->getArgument('path');
        $realPath = realpath($path);

        if (false === $path) {
            // @todo - Add test for this error
            $output->writeln("<error>Path $path does not exist</error>");

            return self::ERROR_CODE_PATH_DOES_NOT_EXISTS;
        }

        $output->writeln("<info>Bootstrapping project in {$realPath}</info>");

        /**
         * Get composer details
         */

        $composerFile = "$realPath/composer.json";
        if (!$fs->exists($composerFile)) {
            // @todo - Add test for this error
            $output->writeln("<error>Missing composer.json file</error>");

            return self::ERROR_CODE_COMPOSER_JSON_FILE_MISSING;
        }
        $composerJson = @json_decode(file_get_contents($composerFile), true);

        if (empty($composerJson)) {
            // @todo - Add test for this error
            $output->writeln("<error>Unable to read composer.json file contents</error>");

            return self::ERROR_CODE_COMPOSER_JSON_DATA_MISSING;
        }

        $output->writeln('<info>Creating package.json file</info>');

        $packageJson = [
            'name'            => str_replace('/', '-', $composerJson['name']),
            'description'     => $composerJson['description'],
            'version'         => $composerJson['version'],
            'license'         => $composerJson['license'],
            'authors'         => $composerJson['authors'],
            'devDependencies' => [
                "gulp"                  => "^3.9.0",
                "gulp-cm-phpspec-tasks" => "^1.1.0",
                "gulp-codeception"      => "^0.5.0",
                "gulp-notify"           => "^2.2.0",
            ],
        ];
        $fs->dumpFile("{$realPath}/package.json", json_encode($packageJson, JSON_PRETTY_PRINT));

        passthru("cd {$realPath} && npm install", $returnCode);

        if (0 !== $returnCode) {
            return self::ERROR_CODE_NPM_INSTALL_FAILED;
        }

        return 0;
    }
}
