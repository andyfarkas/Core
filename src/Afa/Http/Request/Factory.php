<?php

namespace Afa\Http\Request;

class Factory implements IFactory
{

    /**
     * @var \Afa\Application\IConfigurator
     */
    protected $appConfigurator;

    /**
     * @param \Afa\Application\IConfigurator $configurator
     */
    public function __construct(\Afa\Application\IConfigurator $configurator)
    {
        $this->appConfigurator = $configurator;
    }

    /**
     * 
     * @return \Afa\Http\IRequest
     */
    public function create()
    {
        return new \Afa\Http\Request($_SERVER, $this->appConfigurator->getBasePath());
    }

}