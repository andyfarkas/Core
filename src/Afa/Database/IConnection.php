<?php

namespace Afa\Database;

interface IConnection
{
    /**
     * 
     * @param string $query
     * @param mixed[] $arguments
     * @return IResult
     */
    function query($query, array $arguments);

    /**
     * @param $query
     * @param array $arguments
     */
    function execute($query, array $arguments);

}
