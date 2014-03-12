<?php

namespace Afa\Http;

interface IResponse
{
    /**
     * @param Response\ISender $sender
     */
    public function send(Response\ISender $sender);
}