<?php

namespace Afa\Database;

interface IConfigurator
{
    /**
     * @return IConnection
     */
    function createConnection();
}