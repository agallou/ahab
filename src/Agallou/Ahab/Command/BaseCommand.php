<?php

namespace Agallou\Ahab\Command;

use Agallou\Ahab\Ahab;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Agallou\Ahab\ConfigFactory;
use Agallou\Ahab\Application;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseCommand extends Command
{
    /**
     * @var Ahab
     */
    protected $ahab;

    /**
     * @throws \LogicException
     *
     * @return Ahab
     */
    public function getAhab()
    {
        if (null == $this->ahab) {
            throw new \LogicException('Ahab not initialiazed');
        }
        return $this->ahab;
    }

    /**
     *
     */
    protected function configure()
    {
        $this->addArgument('application', InputArgument::REQUIRED);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->ahab = new Ahab($_SERVER['HOME'] . '/.ahab/');
    }

    /**
     * @param InputInterface $input
     *
     * @return \Agallou\Ahab\Config
     */
    protected function getConfiguration(InputInterface $input)
    {
        $ahabConfigPath = $this->getAhab()->getConfigDir();
        $factory =  new ConfigFactory($ahabConfigPath);
        return $factory->load($input->getArgument('application'));

    }

    /**
     * @param InputInterface $input
     *
     * @return Application
     */
    protected function getAhabApplication(InputInterface $input)
    {
        return new Application($this->getConfiguration($input));
    }

    /**
     * @param InputInterface $input
     *
     * @return string
     */
    protected function getContainerId(InputInterface $input)
    {
        return file_get_contents($this->getContainerIdPath($input));
    }

    /**
     * @param InputInterface $input
     *
     * @return string
     */
    protected function getContainerIdPath(InputInterface $input)
    {
        return sprintf('%s/%s', $this->getAhab()->getContainersDir(), $input->getArgument('application'));
    }

}
