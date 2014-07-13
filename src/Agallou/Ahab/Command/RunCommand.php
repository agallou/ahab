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
            ->addOption('force', null, InputOption::VALUE_NONE);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @throws \RuntimeException
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $currentContainerId = $this->getContainerId($input);
        if ($this->getAhabApplication($input)->isContainerIdRunning($currentContainerId)) {
            if ($input->getOption('force')) {
                $this->getAhabApplication($input)->kill($currentContainerId);
            } else {
                throw new \RuntimeException(sprintf('Container %s already running', $currentContainerId));
            }
        }

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
        $command = vsprintf('sudo docker run -i -t -d %s %s %s', array(
            implode(' ', $ports),
            implode(' ', $volumes),
            $runConfig->getName()
        ));
        $output->writeln($command);
        $output = exec($command);
        file_put_contents($this->getContainerIdPath($input), $output);
    }
}
