<?php

namespace Agallou\Ahab\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class EnterCommand extends BaseCommand
{
    /**
     *
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('enter')
            ->setDescription('Enters the container')
            ->addArgument('cmd', InputArgument::OPTIONAL, '', 'bash')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cmd = sprintf('exec >/dev/tty 2>/dev/tty </dev/tty && sudo docker-enter %s %s', $this->getContainerId($input), $input->getArgument('cmd'));
        passthru($cmd);
    }
}

