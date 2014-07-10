<?php

namespace Agallou\Ahab;

class RunConfig
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $volumes = array();

    /**
     * @var array
     */
    protected $ports = array();

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

    /**
     * @param array $volumes
     *
     * @return $this
     */
    public function setVolumes(array $volumes)
    {
        $this->volumes = $volumes;

        return $this;
    }

    /**
     * @return array
     */
    public function getVolumes()
    {
        return $this->volumes;
    }

    /**
     * @param array $ports
     *
     * @return $this
     */
    public function setPorts(array $ports)
    {
        $this->ports = $ports;

        return $this;
    }

    /**
     * @return array
     */
    public function getPorts()
    {
        return $this->ports;
    }
}
