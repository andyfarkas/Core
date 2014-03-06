<?php

namespace Afa\Tests;

class ApplicationTests extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function run_WhenCalled_SendsResponseBasedOnRequest()
    {
        $response = new \Afa\Http\Response\Ok(array());
        $request = new \Afa\Http\Request(array(
            'REQUEST_URI' => '/users/list?page=1',
        ), null);
        
        $requestFactoryMock = $this->getMock('Afa\Http\Request\IFactory');
        $requestFactoryMock->expects($this->any())
                            ->method('create')
                            ->will($this->returnValue($request));
        
        $resourceInvokerMock = $this->getMock('Afa\Http\Resource\IInvoker');
        $resourceInvokerMock->expects($this->any())
                            ->method('invokeResource')
                            ->with('users', 'list', array(
                                'page' => 1,
                            ))->will($this->returnValue($response));
        
        $responderMock = $this->getMock('Afa\Http\Response\ISender');
        $responderMock->expects($this->once())
                        ->method('send')
                        ->with($data = array(), $code = 200);
        
        $application = new \Afa\Application($requestFactoryMock, $resourceInvokerMock, $responderMock);
        $application->run();
    }
}