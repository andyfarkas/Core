<?php

namespace Afa\Database\Repository\Tests;

class GenericRepositoryTests extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function findOne_EmptyResult_ThrowsObjectNotFoundException()
    {        
        $resultMock = $this->getMock('Afa\Database\IResult');
        $resultMock->expects($this->any())
                    ->method('current')
                    ->will($this->returnValue(false));
        
        $connectionMock = $this->getMock('Afa\Database\IConnection');
        $criteriaMock = $this->getMock('Afa\Database\ICriteria');
        $criteriaMock->expects($this->any())
                        ->method('query')
                        ->with($connectionMock)
                        ->will($this->returnValue($resultMock));
        
        $repository = new \Afa\Database\Repository\Generic($connectionMock);
        $this->setExpectedException('Afa\Database\Repository\Exception\ObjectNotFound');
        $repository->findOne($criteriaMock);
    }
    
    /**
     * @test
     */
    public function findOne_OneRowResult_ReturnsCreatedEntity()
    {        
        $result = array(
            'id' => 1,
        );
        $resultMock = $this->getMock('Afa\Database\IResult');
        $resultMock->expects($this->any())
                    ->method('current')
                    ->will($this->returnValue($result));
        
        $connectionMock = $this->getMock('Afa\Database\IConnection');
        $criteriaMock = $this->getMock('Afa\Database\ICriteria');
        $criteriaMock->expects($this->any())
                        ->method('query')
                        ->with($connectionMock)
                        ->will($this->returnValue($resultMock));
        
        $entityMock = $this->getMock('Afa\Database\IEntity');
        $criteriaMock->expects($this->any())
                    ->method('createEntity')
                    ->with($result)
                    ->will($this->returnValue($entityMock));
        
        $repository = new \Afa\Database\Repository\Generic($connectionMock);        
        $result = $repository->findOne($criteriaMock);
        
        $this->assertEquals($entityMock, $result);
    }
}