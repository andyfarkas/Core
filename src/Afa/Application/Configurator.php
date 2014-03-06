<?php

namespace Afa\Application;

class Configurator implements IConfigurator
{
    /**
     * @var array
     */
    protected $config = array();

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->config['basePath'];
    }
}