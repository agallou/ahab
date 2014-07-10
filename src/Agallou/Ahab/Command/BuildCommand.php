<?php
namespace Agallou\Ahab\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Agallou\Ahab\ConfigFactory;
use Agallou\Ahab\Application;



class BuildCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('build')
            ->setDescription('Builds the container')
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
        $application = new Application($config);
        $application->build();
    }
}
