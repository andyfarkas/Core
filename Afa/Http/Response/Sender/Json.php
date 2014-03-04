<?php

namespace Afa\Http\Response\Sender;

class Json implements \Afa\Http\Response\ISender
{
    /**
     * 
     * @param mixed $data
     * @param int $code
     */
    public function send($data, $code)
    {
        header('Content-type: application/json', true, $code);
        echo json_encode($data);
    }

}