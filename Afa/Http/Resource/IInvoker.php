<?php

namespace Afa\Http\Resource;

interface IInvoker
{
    /**
     * 
     * @param string $name
     * @param string $action
     * @param array $parameters
     * @return \Http\IResponse
     */
    function invokeResource($name, $action, array $parameters);
}