<?php

namespace Afa\Http;

interface IRequest
{
    /**
     * 
     * @return IResource
     */
    function mapToResource();
}