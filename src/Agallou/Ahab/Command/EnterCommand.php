<?php
namespace Agallou\Ahab\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class EnterCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('enter')
            ->setDescription('Enters the container')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $containerId = file_get_contents(sprintf('/home/agallou/Projets/%s/.ahabid', $input->getArgument('application')));
        passthru(sprintf('sudo docker-enter %s bash', escapeshellarg($containerId)));
    }
}
