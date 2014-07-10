<?php

namespace Agallou\Ahab;

class Config
{
    /**
     * @var BuildConfig
     */
    protected $build;

    /**
     * @var RunConfig
     */
    protected $run;

    /**
     * @return BuildConfig
     */
    public function getBuild()
    {
        return $this->build;
    }

    /**
     * @param BuildConfig $build
     *
     * @return $this
     */
    public function setBuild(BuildConfig $build)
    {
        $this->build = $build;

        return $this;
    }

    /**
     * @param RunConfig $run
     *
     * @return $this
     */
    public function setRun(RunConfig $run)
    {
        $this->run = $run;

        return $this;
    }

    /**
     * @return RunConfig
     */
    public function getRun()
    {
      return $this->run;
    }


}


