<?php

namespace Afa\Http\Request;

interface IFactory
{
    /**
     * 
     * @return Afa\Http\IRequest
     */
    function create();
}