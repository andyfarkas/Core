<?php

namespace Afa\Database;

interface ICriteria
{
    /**
     * @param \Afa\Database\IConnection $connection
     * @return \Afa\Database\IResult $result
     */
    function query(\Afa\Database\IConnection $connection);
    
    /**     
     * @param array $data
     * @return IEntity
     */
    function createEntity(array $data);
    
}