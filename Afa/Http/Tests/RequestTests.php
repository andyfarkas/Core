<?php

namespace Http\Tests;

class RequestTests extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function mapToResource_FullIdentifierWithQueryParameters_ReturnsResource()
    {
        $request = new \Afa\Http\Request(array(
            'REQUEST_URI' => '/users/find?id=1',
        ));
        
        $expectedResource = new \Afa\Http\Resource('users', 'find', array(
            'id' => 1,
        ));
        
        $result = $request->mapToResource();
        
        $this->assertEquals($expectedResource, $result);
    }
    
    /**
     * @test
     */
    public function mapToResource_IdentifierInRequestedPath_ReturnsResource()
    {
        $request = new \Afa\Http\Request(array(
            'REQUEST_URI' => '/users/1/detail',
        ));
        
        $expectedResource = new \Afa\Http\Resource('users', 'detail', array(
            'id' => 1,
        ));
        
        $result = $request->mapToResource();
        
        $this->assertEquals($expectedResource, $result);
    }
    
    /**
     * @test
     */
    public function mapToResource_IdentifierInRequestedPathWithNoMethod_ReturnsResource()
    {
        $request = new \Afa\Http\Request(array(
            'REQUEST_URI' => '/users/1',
        ));
        
        $expectedResource = new \Afa\Http\Resource('users', 'detail', array(
            'id' => 1,
        ));
        
        $result = $request->mapToResource();
        
        $this->assertEquals($expectedResource, $result);
    }
    
    /**
     * @test
     */
    public function mapToResource_FullIdentifierWithoutQueryParameters_ReturnsResource()
    {
        $request = new \Afa\Http\Request(array(
            'REQUEST_URI' => '/users/find',
        ));
        
        $expectedResource = new \Afa\Http\Resource('users', 'find', array());
        
        $result = $request->mapToResource();
        
        $this->assertEquals($expectedResource, $result);
    }
    
    /**
     * @test
     */
    public function mapToResource_MissingActionName_ReturnsResource()
    {
        $request = new \Afa\Http\Request(array(
            'REQUEST_URI' => '/users',
        ));
        
        $expectedResource = new \Afa\Http\Resource('users', null, array());
        
        $result = $request->mapToResource();
        
        $this->assertEquals($expectedResource, $result);
    }
    
}