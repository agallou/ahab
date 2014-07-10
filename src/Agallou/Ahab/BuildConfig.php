<?php

namespace Agallou\Ahab;

class BuildConfig
{

    /**
     * @var string
     */
    protected $dockerFileDir;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $dockerFileDir
     *
     * @return $this
     */
    public function setDockerFileDir($dockerFileDir)
    {
        $this->dockerFileDir = $dockerFileDir;

        return $this;
    }

    /**
     * @return string
     */
    public function getDockerFileDir()
    {
        return $this->dockerFileDir;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
