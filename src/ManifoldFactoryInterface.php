<?php

namespace EmbarkNow\ManifoldFactory;

/**
 * Manifold Factory
 */
interface ManifoldFactoryInterface
{
    /**
     * Add a factory definition
     * @param string $key
     * @param string $factory
     * @return self
     */
    public function addFactory($key, $factory);

    /**
     * Add an array of factory definitions
     * @param array $factories
     * @return self
     */
    public function addFactories(array $factories);

    /**
     * Check a factory has been set
     * @param  string  $name
     * @return boolean
     */
    public function hasFactory($name);

    /**
     * Get a factory by name
     * @param  strint $name
     * @return array
     */
    public function getFactory($name);

    /**
     * Get all factories
     * @return array
     */
    public function getFactories();

    /**
     * Remove a factory definition
     * @param  string $name
     * @return self
     */
    public function removeFactory($name);

    /**
     * Make an instance of a stored factory
     * @param  string $type
     * @param  array  $data
     * @param  array  $ctorArgs
     * @param  array  $postMethods
     * @return EntityInterface
     */
    public function make($type, array $data, array $ctorArgs = [], array $postMethods = []);
}
