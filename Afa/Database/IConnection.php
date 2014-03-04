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
}
