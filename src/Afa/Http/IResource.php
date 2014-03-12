<?php

namespace Afa\Http;

interface IResource
{
    /**
     *
     * @param Resource\IInvoker $invoker
     * @return IResponse
     */
    public function invoke(Resource\IInvoker $invoker);
}