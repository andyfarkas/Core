<?php

namespace Afa\DIContainer\Tests;

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'classes.php');

class ContainerTests extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function resolve_TypeWithNoConstructor_ReturnsInstanceOfTheClass()
    {
        $classWithNoConstructor = 'Afa\DIContainer\Tests\ClassWithNoConstructor';
        $container = $this->createContainer();
        $instance = $container->resolve($classWithNoConstructor);

        $this->assertInstanceOf($classWithNoConstructor, $instance);
    }
    
    protected function createContainer()
    {
        return new \Afa\DIContainer\Container();
    }

    /**
     * @test
     */
    public function resolve_TypeWithOneArgumentConstructor_ReturnsInstanceOfTheClass()
    {
        $classWithOneArgumentConstructor = 'Afa\DIContainer\Tests\ClassWithOneArgumentConstructor';
        $container = $this->createContainer();
        $instance = $container->resolve($classWithOneArgumentConstructor);

        $this->assertInstanceOf($classWithOneArgumentConstructor, $instance);
    }

    /**
     * @test
     */
    public function resolve_TypeWithTwoArgumentsConstructor_ReturnsInstanceOfTheClass()
    {
        $classWithTwoArgumentsConstructor = 'Afa\DIContainer\Tests\ClassWithTwoArgumentConstructor';
        $container = $this->createContainer();
        $instance = $container->resolve($classWithTwoArgumentsConstructor);

        $this->assertInstanceOf($classWithTwoArgumentsConstructor, $instance);
    }

    /**
     * @test
     */
    public function resolve_NonInstantiableType_ThrowsRuntimeException()
    {
        $container = $this->createContainer();
        $this->setExpectedException('RuntimeException');
        $container->resolve('Afa\DIContainer\Tests\ISampleInterface');
    }

    /**
     * @test
     */
    public function resolve_BoundAbstractType_ReturnsInstanceOfConcreteType()
    {
        $container = $this->createContainer();
        $container->bindTypeTo('Afa\DIContainer\Tests\ISampleInterface', 'Afa\DIContainer\Tests\ClassImplementingISampleInterface');

        $instance = $container->resolve('Afa\DIContainer\Tests\ISampleInterface');
        $this->assertInstanceOf('Afa\DIContainer\Tests\ClassImplementingISampleInterface', $instance);
    }

    /**
     * @test
     */
    public function resolve_TypeWithConstructorWithoutParameterTypeHint_ThrowsRuntimeException()
    {
        $container = $this->createContainer();
        $this->setExpectedException('RuntimeException');
        $container->resolve('Afa\DIContainer\Tests\ClassWithConstructorWithoutTypeHint');
    }

    /**
     * @test
     */
    public function resolve_WhenCalledMultipleTimesForSameType_ReturnsTheSameInstance()
    {
        $container = $this->createContainer();
        $firstInstance = $container->resolve('Afa\DIContainer\Tests\ClassWithNoConstructor');
        $secondInstance = $container->resolve('Afa\DIContainer\Tests\ClassWithNoConstructor');
        $this->assertSame($firstInstance, $secondInstance);
    }

    /**
     * @test
     */
    public function resolve_TypeWithCircularDependencies_ThrowsRuntimeException()
    {
        $container = $this->createContainer();
        $this->setExpectedException('RuntimeException');
        $container->resolve('Afa\DIContainer\Tests\ClassWithCircularDependecies');
    }

    /**
     * @test
     */
    public function bindTypeTo_CalledMultipleTimesForSameType_ThrowsInvalidArgumentException()
    {
        $container = $this->createContainer();
        $container->bindTypeTo('Afa\DIContainer\Tests\ClassWithNoConstructor', 'Afa\DIContainer\Tests\ClassWithNoConstructor');
        $this->setExpectedException('InvalidArgumentException');
        $container->bindTypeTo('Afa\DIContainer\Tests\ClassWithNoConstructor', 'Afa\DIContainer\Tests\ClassWithNoConstructor');
    }

    /**
     * @test
     */
    public function resolve_InstanceBoundToType_ReturnsThatInstance()
    {
        $container = $this->createContainer();
        $instance = new ClassWithNoConstructor();

        $container->bindTypeToInstance('Afa\DIContainer\Tests\ClassWithNoConstructor', $instance);
        $resolved = $container->resolve('Afa\DIContainer\Tests\ClassWithNoConstructor');

        $this->assertSame($instance, $resolved);
    }

}
