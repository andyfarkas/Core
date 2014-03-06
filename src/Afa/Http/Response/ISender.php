<?php

namespace Afa\Http\Response;

interface ISender
{
    /**
     * @param string $data
     * @param int $code
     */
    function send($data, $code);
}