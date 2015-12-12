<?php

namespace EmbarkNow\Tests\ManifoldFactory;

use EmbarkNow\Tests\ManifoldFactory\TraitImplementation;

/**
 * FactoryBasicsTrait Test
 */
class FactoryBasicsTraitTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new TraitImplementation;
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
        $this->factory->addFactoryType('mushroom', 'StdClass');
    }

    public function addTypes()
    {
        $this->factory->addFactoryTypes([
            'mushroom' => 'StdClass',
            'badger' => 'StdClass'
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

    public function testHasFactoryType()
    {
        $this->addType();
        $this->assertTrue($this->factory->hasFactoryType('mushroom'));
    }

    public function testGetFactoryType()
    {
        $this->addType();
        $this->assertEquals($this->factory->getFactoryType('mushroom'), 'StdClass');
    }

    public function testGetFactoryTypes()
    {
        $this->addTypes();
        $types = $this->factory->getFactoryTypes();
        $this->assertArrayHasKey('badger', $types);
    }

    public function removeFactoryType()
    {
        $this->addTypes();
        $types = $this->factory->removeFactoryType('mushroom');
        $this->assertArrayNotHasKey('mushroom', $types);
    }
}
