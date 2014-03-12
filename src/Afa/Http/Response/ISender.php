<?php

namespace Afa\Http\Response;

interface ISender
{
    /**
     * @param string $data
     * @param int $code
     */
    public function send($data, $code);
}