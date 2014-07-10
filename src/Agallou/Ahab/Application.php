<?php

namespace Agallou\Ahab;

class Application
{

    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function build()
    {
        $buildConfig = $this->config->getBuild();
        $command = vsprintf(
            'sudo docker build -t %s %s',
            array(
                escapeshellarg($buildConfig->getName()),
                escapeshellarg($buildConfig->getDockerfileDir()),
            )
        );

        passthru($command);
    }

}
