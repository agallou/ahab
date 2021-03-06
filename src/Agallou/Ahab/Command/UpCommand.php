<?php

namespace Agallou\Ahab\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

/**
 */
class UpCommand extends BaseCommand
{
    /**
     *
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('up')
            ->setDescription('Builds and run the container')
            ->addOption('force', null, InputOption::VALUE_NONE);
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find('build');

        $arguments = array(
            'command' => 'build',
            'application' => $input->getArgument('application'),
        );

        $arrayInput = new ArrayInput($arguments);
        $returnCode = $command->run($arrayInput, $output);


        $command = $this->getApplication()->find('run');

        $arguments = array(
            'command' => 'run',
            'application' => $input->getArgument('application'),
            '--force' => $input->getOption('force'),
        );

        $arrayInput = new ArrayInput($arguments);
        $returnCode = $command->run($arrayInput, $output);
    }
}
