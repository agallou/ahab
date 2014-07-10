<?php

namespace Agallou\Ahab\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Agallou\Ahab\ConfigFactory;
use Agallou\Ahab\Application;

class RunCommand extends BaseCommand
{
    /**
     *
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('run')
            ->setDescription('Run the container')
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
        $config = $this->getConfiguration($input);
        $runConfig = $config->getRun();
        $ports = array();
        foreach ($runConfig->getPorts() as $port) {
            $ports[] = ' -p ' . $port;
        }
        $volumes = array();
        foreach ($runConfig->getVolumes() as $volume) {
            $volumes[] = ' --volume=' . $volume;
        }
        $command = sprintf('sudo docker run -i -t -d %s %s %s', implode(' ', $ports), implode(' ', $volumes), $runConfig->getName());
        $output->writeln($command);
        $output = exec($command);
        file_put_contents($this->getContainerIdPath($input), $output);
    }
}
