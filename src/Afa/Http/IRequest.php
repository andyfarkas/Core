<?php

namespace Afa\Http;

interface IRequest
{
    /**
     * 
     * @return IResource
     */
    public function mapToResource();
}