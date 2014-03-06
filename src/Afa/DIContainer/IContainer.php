<?php

namespace Afa\DIContainer;

interface IContainer
{

    /**
     *
     * @param string $type
     * @return object
     */
    function resolve($type);

    /**
     *
     * @param string $type
     * @param string $concreteType
     */
    function bindTypeTo($type, $concreteType);

    /**
     *
     * @param string $type
     * @param object $instance
     */
    function bindTypeToInstance($type, $instance);
}
