<?php

namespace Agallou\Ahab;

class BuildConfig
{

    protected $dockerFileDir;

    protected $name;

    public function setDockerFileDir($dockerFileDir)
    {
        $this->dockerFileDir = $dockerFileDir;

        return $this;
    }

    public function getDockerFileDir()
    {
       return $this->dockerFileDir;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

}
