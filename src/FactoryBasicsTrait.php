<?php

namespace EmbarkNow\ManifoldFactory;

/**
 * Factory Basics trait
 */
trait FactoryBasicsTrait
{
    /**
     * @var array
     */
    protected $factoryTypes;

    /**
     * Add a factory definition
     * @param string $key
     * @param mixed $factory
     * @return self
     */
    public function addFactoryType($key, $factory)
    {
        if (null === $this->factoryTypes) {
            $this->factories = [];
        }

        if (!array_key_exists($key, $this->factoryTypes)) {
            $this->factoryTypes[$key] = $factory;
        }

        return $this;
    }

    /**
     * Add an array of factory definitions
     * @param array $factoryTypes
     * @return self
     */
    public function addFactoryTypes(array $factoryTypes)
    {
        foreach ($factoryTypes as $key => $factory) {
            $this->addFactory($key, $factory);
        }

        return $this;
    }

    /**
     * Check a factory has been set
     * @param  string  $name
     * @return boolean
     */
    public function hasFactory($name)
    {
        return isset($this->factoryTypes[$name]);
    }

    /**
     * Get a factory by name
     * @param  strint $name
     * @return array
     */
    public function getFactory($name)
    {
        return $this->factoryTypes[$name];
    }

    /**
     * Get all factories
     * @return array
     */
    public function getFactories()
    {
        return $this->factoryTypes;
    }

    /**
     * Remove a factory definition
     * @param  string $name
     * @return self
     */
    public function removeFactory($name)
    {
        unset($this->factoryTypes[$name]);

        return $this;
    }
}
