<?php

namespace Agallou\Ahab\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class KillCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('kill')
            ->setDescription('Kills the container')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $containerId = file_get_contents(sprintf('/home/agallou/Projets/%s/.ahabid', $input->getArgument('application')));
        exec(sprintf('sudo docker kill %s', escapeshellarg($containerId)));
    }
}
