<?php

namespace Afa\Database\Entity;

interface IBuilder
{
    /**
     *
     * @param array $data
     * @return \Afa\Database\IEntity
     */
    function createEntity(array $data);
}