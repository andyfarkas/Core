<?php

namespace Afa\Database;

interface ICommand
{
    /**
     * @param IConnection $connection
     * @return IResult
     */
    public function run(IConnection $connection);
}