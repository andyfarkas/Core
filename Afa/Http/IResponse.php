<?php

namespace Afa\Http;

interface IResponse
{
    /**
     * @param Response\ISender $sender
     */
    function send(Response\ISender $sender);
}