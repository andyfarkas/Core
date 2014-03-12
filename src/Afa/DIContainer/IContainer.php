<?php

namespace Afa\DIContainer;

interface IContainer
{

    /**
     *
     * @param string $type
     * @return object
     */
    public function resolve($type);

    /**
     *
     * @param string $type
     * @param string $concreteType
     */
    public function bindTypeTo($type, $concreteType);

    /**
     *
     * @param string $type
     * @param object $instance
     */
    public function bindTypeToInstance($type, $instance);
}
