<?php

namespace Afa\Http;

interface IResource
{
    /**
     * 
     * @return IResponse
     */
    function invoke(Resource\IInvoker $invoker);
}