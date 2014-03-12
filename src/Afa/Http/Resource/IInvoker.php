<?php

namespace Afa\Http\Resource;

interface IInvoker
{
    /**
     * 
     * @param string $name
     * @param string $action
     * @param array $parameters
     * @return \Afa\Http\IResponse
     */
    public function invokeResource($name, $action, array $parameters);
}