<?php

namespace Afa\Http\Resource\Invoker;

abstract class AbstractInvoker implements \Afa\Http\Resource\IInvoker
{
    /**
     *
     * @var \Afa\DIContainer\IContainer
     */
    protected $container;

    /**
     *
     * @param \Afa\DIContainer\IContainer $container
     */
    public function __construct(\Afa\DIContainer\IContainer $container)
    {
        $this->container = $container;
    }

    /**
     *
     * @param string $name
     * @param string $action
     * @param array $parameters
     * @return \Afa\Http\IResponse
     */
    public function invokeResource($name, $action, array $parameters)
    {
        $classname = $this->resolveClassname($name, $action, $parameters);

        try
        {
            $resource = $this->container->resolve($classname);
        }
        catch(\Exception $e)
        {
            return new \Afa\Http\Response\ServerError(array(
                'error' => $e->getMessage(),
            ));
        }

        if (!method_exists($resource, $action))
        {
            return new \Afa\Http\Response\ServerError(array(
                'error' => 'Method \'' . $action . '\' is not callable on resource \'' . $classname . '\'',
            ));
        }

        $response = call_user_func_array(array($resource, $action), array($parameters));

        if (!($response instanceof \Afa\Http\IResponse))
        {
            return new \Afa\Http\Response\ServerError(array(
                'error' => 'Method \'' . $classname . ':' . $action . '\' failed to return valid response',
            ));
        }

        return $response;
    }

    abstract protected function resolveClassname($name, $action, array $parameters);

}