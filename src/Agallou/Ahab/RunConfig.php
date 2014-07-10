<?php

namespace Agallou\Ahab;

class RunConfig
{

    protected $name;

    protected $volumes = array();

    protected $ports = array();

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setVolumes(array $volumes) {
      $this->volumes = $volumes;
      return $this;
    }

    public function getVolumes()
    {
      return $this->volumes;
    }

    public function setPorts(array $ports) {
      $this->ports = $ports;
      return $this;
    }

    public function getPorts()
    {
      return $this->ports;
    }



}
