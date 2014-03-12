<?php

namespace Afa\Http\Resource\Invoker;

class Module extends AbstractInvoker
{
    /**
     * @param string $name
     * @param string $action
     * @param array $parameters
     * @return string
     */
    protected function resolveClassname($name, $action, array $parameters)
    {
        return ucfirst($name) . '\Resource';
    }
}