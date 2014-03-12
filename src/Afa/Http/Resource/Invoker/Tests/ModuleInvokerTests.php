<?php

namespace Afa\Http\Resource\Invoker\Tests;

class ModuleInvokerTests extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function invokeResource_WhenCalledByNameAndAction_ReturnsResponse()
    {
        $expectedResponse = $this->getMock('Afa\Http\IResponse');
        $resourceMock = $this->getMock('Afa\Http\Resource\Invoker\Tests\IUsersResource');

        $containerMock = $this->getMock('Afa\DIContainer\IContainer');
        $containerMock->expects($this->any())
            ->method('resolve')
            ->with('Users\Resource')
            ->will($this->returnValue($resourceMock));

        $parameters = array();
        $resourceMock->expects($this->any())
            ->method('find')
            ->with($parameters)
            ->will($this->returnValue($expectedResponse));

        $invoker = new \Afa\Http\Resource\Invoker\Module($containerMock);
        $response = $invoker->invokeResource('users', 'find', $parameters);

        $this->assertEquals($expectedResponse, $response);
    }

    /**
     * @test
     */
    public function invokeResource_NonExistingResourceClass_ReturnsServerErrorResponse()
    {
        $containerMock = $this->getMock('Afa\DIContainer\IContainer');
        $containerMock->expects($this->any())
            ->method('resolve')
            ->with('Users\Resources')
            ->will($this->throwException(new \RuntimeException()));

        $parameters = array();

        $invoker = new \Afa\Http\Resource\Invoker\Module($containerMock);
        $response = $invoker->invokeResource('users', 'find', $parameters);

        $this->assertInstanceOf('Afa\Http\Response\ServerError', $response);
    }

    /**
     * @test
     */
    public function invokeResource_NonExistingAction_ReturnsServerErrorResponse()
    {
        $resourceMock = $this->getMock('Afa\Http\Resource\Invoker\Tests\IUsersResource');

        $containerMock = $this->getMock('Afa\DIContainer\IContainer');
        $containerMock->expects($this->any())
            ->method('resolve')
            ->with('Users\Resources')
            ->will($this->returnValue($resourceMock));

        $parameters = array();
        $invoker = new \Afa\Http\Resource\Invoker\Module($containerMock);
        $response = $invoker->invokeResource('users', 'unknownMethod', $parameters);

        $this->assertInstanceOf('Afa\Http\Response\ServerError', $response);
    }

    /**
     * @test
     */
    public function invokeResource_ResourceNotReturningResponse_ReturnsServerErrorResponse()
    {
        $parameters = array();
        $resourceMock = $this->getMock('Tests\IUsersResource');
        $resourceMock->expects($this->any())
            ->method('find')
            ->with($parameters)
            ->will($this->returnValue(null));

        $containerMock = $this->getMock('Afa\DIContainer\IContainer');
        $containerMock->expects($this->any())
            ->method('resolve')
            ->with('Users\Resources')
            ->will($this->returnValue($resourceMock));


        $invoker = new \Afa\Http\Resource\Invoker\Module($containerMock);
        $response = $invoker->invokeResource('users', 'find', $parameters);

        $this->assertInstanceOf('Afa\Http\Response\ServerError', $response);
    }

}