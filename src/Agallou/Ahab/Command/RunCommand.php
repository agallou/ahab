<?php
namespace Agallou\Ahab\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Agallou\Ahab\ConfigFactory;
use Agallou\Ahab\Application;

class RunCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription('Run the container')
            ->addArgument('application')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ahabPath = $_SERVER['HOME'] . '/.ahab/';
        $ahabConfigPath = $ahabPath . '/config/';
        $output->writeLn($ahabConfigPath);

        if (!is_dir($ahabConfigPath)) {
            mkdir($ahabConfigPath, 0777, true);
        }

        $factory =  new ConfigFactory($ahabConfigPath);
        $config = $factory->load($input->getArgument('application'));


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
        file_put_contents(sprintf('/home/agallou/Projets/%s/.ahabid', $input->getArgument('application')), $output);
    }
}
