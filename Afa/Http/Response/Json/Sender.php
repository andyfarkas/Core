<?php

namespace Afa\Http\Response\Json;

class Sender implements Afa\Response\ISender
{
    /**
     * 
     * @param mixed $data
     * @param int $code
     */
    public function send($data, $code)
    {
        header('Content-type: application/json', true, $code);
        json_encode($data);
    }

}