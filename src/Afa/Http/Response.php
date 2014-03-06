<?php

namespace Afa\Http;

class Response implements \Afa\Http\IResponse
{
    
    /**
     *
     * @var mixed
     */
    protected $data;
    
    /**
     *
     * @var int
     */
    protected $code;
    
    /**
     * 
     * @param mixed $data
     * @param int $code
     */
    public function __construct($data)
    {
        $this->data = $data;        
    }
    
    /**
     * 
     * @param Response\ISender $sender
     */
    public function send(Response\ISender $sender)
    {
        $sender->send($this->data, $this->code);
    }

}