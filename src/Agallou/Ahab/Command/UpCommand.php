<?php
namespace Agallou\Ahab\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;


class UpCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('up')
            ->setDescription('Builds and run the container')
            ->addArgument('application')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find('build');

        $arguments = array(
            'command' => 'build',
            'application' => $input->getArgument('application'),
        );

        $input = new ArrayInput($arguments);
        $returnCode = $command->run($input, $output);


        $command = $this->getApplication()->find('run');

        $arguments = array(
            'command' => 'run',
            'application' => $input->getArgument('application'),
        );

        $input = new ArrayInput($arguments);
        $returnCode = $command->run($input, $output);
    }
}
