<?php

namespace Agallou\Ahab\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Agallou\Ahab\ConfigFactory;
use Agallou\Ahab\Application;

abstract class BaseCommand extends Command
{
    /**
     *
     */
    protected function configure()
    {
        $this->addArgument('application', InputArgument::REQUIRED);
    }

    /**
     * @return string
     */
    protected function initAhabConfigDirectory()
    {
        $ahabPath = $_SERVER['HOME'] . '/.ahab/';
        $ahabConfigPath = $ahabPath . '/config/';

        if (!is_dir($ahabConfigPath)) {
            mkdir($ahabConfigPath, 0777, true);
        }

        return $ahabConfigPath;
    }

    /**
     * @param InputInterface $input
     *
     * @return \Agallou\Ahab\Config
     */
    protected function getConfiguration(InputInterface $input)
    {
        $ahabConfigPath = $this->initAhabConfigDirectory();
        $factory =  new ConfigFactory($ahabConfigPath);
        return $factory->load($input->getArgument('application'));

    }

    protected function getAhabApplication(InputInterface $input)
    {
        return new Application($this->getConfiguration($input));
    }

}
