<?php

namespace Afa\Http\Resource\Invoker;

class Conventional extends AbstractInvoker
{
    /**
     * @param string $name
     * @param string $action
     * @param array $parameters
     * @return string
     */
    protected function resolveClassname($name, $action, array $parameters)
    {
        return 'Resources\\' . ucfirst($name);
    }
}