<?php

namespace Agallou\Ahab;

use Symfony\Component\Yaml\Parser;

class ConfigFactory
{

    /**
     * @var string
     */
    protected $configPath;

    /**
     * @param string $configPath
     */
    public function __construct($configPath)
    {
        $this->configPath = $configPath;
    }

    /**
     * @param string $application
     * @param string $dataDir
     *
     * @throws \RuntimeException
     * @return Config
     *
     */
    public function load($application, $dataDir)
    {

        $configPath = $this->configPath . $application;
        $yaml = new Parser();
        if (!is_file($configPath)) {
            throw new \RuntimeException('No config file');
        }

        $content = file_get_contents($configPath);
        if (false === $content) {
            throw new \RuntimeException('No config file');
        }
        $value = $yaml->parse($content);

        $buildConfig = new BuildConfig();
        $buildConfig->setDockerfileDir($value['build']['dockerfile_dir']);
        $buildConfig->setName($value['build']['name']);

        $volumes = array();
        foreach ($value['run']['volumes'] as $volume) {
            $volumes[] = str_replace('%data_dir%', $dataDir, $volume);
        }

        $runConfig = new RunConfig();
        $runConfig
            ->setName($value['run']['name'])
            ->setPorts($value['run']['ports'])
            ->setVolumes($volumes)
        ;

        $config = new Config();
        $config->setBuild($buildConfig);
        $config->setRun($runConfig);

        return $config;
    }
}
