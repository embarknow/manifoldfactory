<?php

namespace EmbarkNow\ManifoldFactory;

/**
 * Manifold Factory
 */
interface FactoryInterface
{
    /**
     * Add a factory definition
     * @param string $key
     * @param mixed $factory
     * @return self
     */
    public function addFactoryType($key, $factory);

    /**
     * Add an array of factory definitions
     * @param array $factoryTypes
     * @return self
     */
    public function addFactoryTypes(array $factoryTypes);

    /**
     * Check a factory has been set
     * @param  string  $name
     * @return boolean
     */
    public function hasFactoryType($name);

    /**
     * Get a factory by name
     * @param  strint $name
     * @return array
     */
    public function getFactoryType($name);

    /**
     * Get all factories
     * @return array
     */
    public function getFactoryTypes();

    /**
     * Remove a factory definition
     * @param  string $name
     * @return self
     */
    public function removeFactoryType($name);

    /**
     * Make an instance of a stored factory
     * @param  string $type
     * @param  array  $ctorArgs
     * @param  array  $postMethods
     * @return mixed
     */
    public function make($type, array $ctorArgs = [], array $postMethods = []);
}
