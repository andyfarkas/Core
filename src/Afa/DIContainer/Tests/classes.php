<?php

namespace Afa\DIContainer\Tests;

class ClassWithNoConstructor
{
    
}

class ClassWithOneArgumentConstructor
{

    public function __construct(ClassWithNoConstructor $classWithNoConstructor)
    {
        
    }

}

class ClassWithTwoArgumentConstructor
{

    public function __construct(ClassWithNoConstructor $classWithNoConstructor, ClassWithNoConstructor $anotherClassWithNoConstructor)
    {
        
    }

}

interface ISampleInterface
{
    
}

class ClassImplementingISampleInterface implements ISampleInterface
{
    
}

class ClassWithConstructorWithoutTypeHint
{

    public function __construct($parameter)
    {
        
    }

}

class ClassWithCircularDependecies
{

    public function __construct(ClassWithCircularDependecies $classWithCircularDependecies)
    {
        
    }

}
