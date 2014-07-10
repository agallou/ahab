<?php

namespace Agallou\Ahab;

class Config
{

    protected $build;

    protected $run;

    public function getBuild()
    {
        return $this->build;
    }

    public function setBuild($build)
    {
        $this->build = $build;

        return $this;
    }

    public function setRun($run)
    {
        $this->run = $run;

        return $this;
    }

    public function getRun()
    {
      return $this->run;
    }


}


