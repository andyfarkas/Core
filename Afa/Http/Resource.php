<?php

namespace Afa\Http;

class Resource implements IResource
{
    /**
     *
     * @var string
     */
    protected $name;
    
    /**
     *
     * @var string
     */
    protected $action;
    
    /**
     *
     * @var array
     */
    protected $queryParameters = array();
    
    /**
     * 
     * @param string $name
     * @param string $action
     * @param array $queryParameters
     */
    public function __construct($name, $action, array $queryParameters)
    {
        $this->name = $name;
        $this->action = $action;
        $this->queryParameters = $queryParameters;
    }
    
    /**
     * 
     * @param \Http\Resource\IInvoker $invoker
     * @return IResponse
     */
    public function invoke(Resource\IInvoker $invoker)
    {
        return $invoker->invokeResource($this->name, $this->action, $this->queryParameters);
    }

}