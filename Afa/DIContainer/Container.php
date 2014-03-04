<?php

namespace Afa\DIContainer;

class Container implements IContainer
{

    /**
     *
     * @var string[]
     */
    protected $types = array();

    /**
     *
     * @var object[]
     */
    protected $createdInstances = array();

    /**
     *
     * @var string[]
     */
    protected $typesBeingCreated = array();

    /**
     * Creates an instance of given type
     * @param string $type
     * @return object
     */
    public function resolve($type)
    {
        if (!isset($this->createdInstances[$type]))
        {
            $this->createInstanceForType($type);
        }

        return $this->createdInstances[$type];
    }

    /**
     * 
     * @param string $type
     * @throws \RuntimeException
     */
    protected function createInstanceForType($type)
    {
        $reflectionClass = $this->getReflectionClassForType($type);
        if (!$reflectionClass->isInstantiable())
        {
            throw new \RuntimeException('Can not create instance of type: ' . $type);
        }

        if (isset($this->typesBeingCreated[$type]))
        {
            throw new \RuntimeException('Circular reference found for type: ' . $type);
        }

        $this->typesBeingCreated[$type] = $type;
        $instance = $this->getInstanceFromReflection($reflectionClass);
        $this->createdInstances[$type] = $instance;
        $this->typesBeingCreated = array();
    }

    /**
     * 
     * @param string $type
     * @return \ReflectionClass
     */
    protected function getReflectionClassForType($type)
    {
        $concreteType = $type;
        if (isset($this->types[$type]))
        {
            $concreteType = $this->types[$type];
        }

        $reflectionClass = new \ReflectionClass($concreteType);
        return $reflectionClass;
    }

    /**
     * 
     * @param \ReflectionClass $reflectionClass
     * @return object
     */
    protected function getInstanceFromReflection(\ReflectionClass $reflectionClass)
    {
        $constructor = $reflectionClass->getConstructor();
        if (!is_object($constructor))
        {
            return $reflectionClass->newInstanceArgs();
        }

        $parameterObjects = $this->getConstructorParametersInstances($constructor, $reflectionClass);
        return $reflectionClass->newInstanceArgs($parameterObjects);
    }

    /**
     * 
     * @param \ReflectionMethod $constructor
     * @param \ReflectionClass $reflectionClass
     * @return object[]
     * @throws \RuntimeException
     */
    protected function getConstructorParametersInstances(\ReflectionMethod $constructor, \ReflectionClass $reflectionClass)
    {
        $constructorParameters = $constructor->getParameters();
        $parameterObjects = array();

        foreach ($constructorParameters as $parameter) /* @var $parameter \ReflectionParameter */
        {
            $parameterClass = $parameter->getClass();
            if (!is_object($parameterClass))
            {
                throw new \RuntimeException('No type hint for parameter: ' . $parameter->getName() . ' in class: ' . $reflectionClass->getName());
            }

            $parameterObjects[] = $this->resolve($parameterClass->getName());
        }

        return $parameterObjects;
    }

    /**
     * Binds a type to a concrete implementation
     * @param string $type
     * @param string $concreteType
     * @throws \InvalidArgumentException
     */
    public function bindTypeTo($type, $concreteType)
    {
        if (isset($this->types[$type]))
        {
            throw new \InvalidArgumentException('Type ' . $type . ' is already bound.');
        }

        $this->types[$type] = $concreteType;
    }

    /**
     * Binds type to concrete instance
     * @param string $type
     * @param object $instance
     */
    public function bindTypeToInstance($type, $instance)
    {
        $this->createdInstances[$type] = $instance;
    }

}
