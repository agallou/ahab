<?php

namespace Agallou\Ahab;

class Ahab
{
    /**
     * @var
     */
    protected $path;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function initAhabSubdirectory($name)
    {
        $ahabConfigPath = sprintf('%s/%s/', $this->getPath(), $name);

        if (!is_dir($ahabConfigPath)) {
            mkdir($ahabConfigPath, 0777, true);
        }

        return $ahabConfigPath;
    }

    /**
     * @return string
     */
    public function getConfigDir()
    {
        return $this->initAhabSubdirectory('config');
    }

    /**
     * @return string
     */
    public function getContainersDir()
    {
        return $this->initAhabSubdirectory('containers');
    }

} 
