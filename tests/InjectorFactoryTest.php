<?php

namespace EmbarkNow\Tests\ManifoldFactory;

use Auryn\Injector;
use EmbarkNow\ManifoldFactory\InjectorFactory;

/**
 * InjectorFactory Test
 */
class InjectorFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $injector = new Injector;
        $this->factory = new InjectorFactory($injector);
    }

    public function getInternal($source)
    {
        $reflection = new \ReflectionClass($this->factory);
        $property = $reflection->getProperty($source);
        $property->setAccessible(true);

        return $property->getValue($this->factory);
    }

    public function addType()
    {
        $this->factory->addFactoryType('mushroom', ['StdClass']);
    }

    public function addTypes()
    {
        $this->factory->addFactoryTypes([
            'mushroom' => ['StdClass'],
            'badger' => ['StdClass']
        ]);
    }

    public function addBadType()
    {
        $this->factory->addFactoryType('mushroom', 'StdClass');
    }

    public function addBadTypes()
    {
        $this->factory->addFactoryTypes([
            'mushroom' => 'StdClass'
        ]);
    }

    public function testAddFactoryType()
    {
        $this->addType();
        $factoryTypes = $this->getInternal('factoryTypes');
        $this->assertArrayHasKey('mushroom', $factoryTypes);
    }

    public function testAddFactoryTypes()
    {
        $this->addTypes();
        $factoryTypes = $this->getInternal('factoryTypes');
        $this->assertArrayHasKey('badger', $factoryTypes);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddFactoryTypeThrowsException()
    {
        $this->addBadType();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddFactoryTypesThrowsException()
    {
        $this->addBadTypes();
    }

    public function testMake()
    {
        $this->addType();
        $instance = $this->factory->make('mushroom');
        $this->assertInstanceOf('StdClass', $instance);
    }
}
