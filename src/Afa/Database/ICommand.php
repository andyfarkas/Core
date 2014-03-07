<?php

namespace Afa\Database;

interface ICommand
{
    /**
     * @param IConnection $connection
     * @return IResult
     */
    function run(IConnection $connection);
}