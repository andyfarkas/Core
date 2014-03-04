<?php

namespace Afa\Http\Request;

class Factory implements IFactory
{
    /**
     * 
     * @return \Http\Request
     */
    public function create()
    {
        return new \Http\Request($_SERVER);
    }

}