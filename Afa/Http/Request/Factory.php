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
        return new \Afa\Http\Request($_SERVER);
    }

}