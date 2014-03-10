<?php

namespace Afa\Http\Tests;

class RequestTests extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function mapToResource_FullIdentifierWithQueryParameters_ReturnsResource()
    {
        $request = new \Afa\Http\Request(array(
            'REQUEST_URI' => '/users/find?id=1',
        ), null);
        
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
        ), null);
        
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
        ), null);
        
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
        ), null);
        
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
        ), null);
        
        $expectedResource = new \Afa\Http\Resource('users', null, array());
        
        $result = $request->mapToResource();
        
        $this->assertEquals($expectedResource, $result);
    }
    /**
     * @test
     */
    public function mapToResource_RequestWithPrefixedPath_ReturnsResource()
    {
        $request = new \Afa\Http\Request(array(
            'REQUEST_URI' => 'prefix/users/action',
        ), 'prefix/');

        $expectedResource = new \Afa\Http\Resource('users', 'action', array());

        $result = $request->mapToResource();

        $this->assertEquals($expectedResource, $result);
    }
    
}