<?php

namespace Agallou\Ahab;

class Application
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     *
     */
    public function build()
    {
        $buildConfig = $this->config->getBuild();
        $command = vsprintf(
            'docker build -t %s %s',
            array(
                escapeshellarg($buildConfig->getName()),
                escapeshellarg($buildConfig->getDockerfileDir()),
            )
        );

        passthru($command);
    }

    /**
     * @param string $containerId
     *
     * @return bool
     */
    public function isContainerIdRunning($containerId)
    {
        $command = vsprintf('docker ps -q --no-trunc | grep %s | wc -l', array(
                escapeshellarg($containerId)
            ));
        $output = exec($command);

        return($output == 1);
    }

    /**
     * @param string $containerId
     *
     * @return string
     */
    public function kill($containerId)
    {
        exec(sprintf('docker kill %s', escapeshellarg($containerId)));
    }
}
