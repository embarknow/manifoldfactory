<?php

namespace EmbarkNow\Tests\ManifoldFactory;

use EmbarkNow\ManifoldFactory\SimpleFactory;

/**
 * SimpleFactory Test
 */
class SimpleFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new SimpleFactory;
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

    public function testMake()
    {
        $this->addType();
        $instance = $this->factory->make('mushroom');
        $this->assertInstanceOf('StdClass', $instance);
    }
}
