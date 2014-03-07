<?php

namespace Afa\Database;

interface ICommand
{
    /**
     * @param IConnection $connection
     */
    function run(IConnection $connection);
}