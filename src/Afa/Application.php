<?php

namespace Afa;

class Application
{
    /**
     *
     * @var Http\Request\IFactory
     */
    protected $requestFactory;
    
    /**
     *
     * @var Http\Resource\IInvoker
     */
    protected $resourceInvoker;
    
    /**
     *
     * @var Http\Response\ISender
     */
    protected $responseSender;

    /**
     *
     * @param \Afa\Http\Request\IFactory $requestFactory
     * @param \Afa\Http\Resource\IInvoker $resourceInvoker
     * @param \Afa\Http\Response\ISender $responseSender
     */
    public function __construct(Http\Request\IFactory $requestFactory, 
                                    Http\Resource\IInvoker $resourceInvoker,
                                    Http\Response\ISender $responseSender)
    {
        $this->requestFactory = $requestFactory;
        $this->resourceInvoker = $resourceInvoker;
        $this->responseSender = $responseSender;
    }
    
    public function run()
    {
        $request = $this->requestFactory->create();
        $resource = $request->mapToResource();
        $response = $resource->invoke($this->resourceInvoker);
        $response->send($this->responseSender);
    }
}