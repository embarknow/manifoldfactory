<?php

namespace EmbarkNow\ManifoldFactory;

use EmbarkNow\ManifoldFactory\FactoryInterface;

class Factory implements FactoryInterface
{
    /**
     * @var array
     */
    protected $factories;

    /**
     * Add a factory definition
     * @param string $key
     * @param string $factory
     * @return self
     */
    public function addFactory($key, $factory)
    {
        if (null === $this->factories) {
            $this->factories = [];
        }

        if (!array_key_exists($key, $this->factories)) {
            $this->factories[$key] = $factory;
        }

        return $this;
    }

    /**
     * Add an array of factory definitions
     * @param array $factories
     * @return self
     */
    public function addFactories(array $factories)
    {
        foreach ($factories as $key => $factory) {
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
        return isset($this->factories[$name]);
    }

    /**
     * Get a factory by name
     * @param  strint $name
     * @return array
     */
    public function getFactory($name)
    {
        return $this->factories[$name];
    }

    /**
     * Get all factories
     * @return array
     */
    public function getFactories()
    {
        return $this->factories;
    }

    /**
     * Remove a factory definition
     * @param  string $name
     * @return self
     */
    public function removeFactory($name)
    {
        unset($this->factories[$name]);

        return $this;
    }

    /**
     * Make an instance of a stored factory
     * @param  string $type
     * @param  array  $data
     * @param  array  $ctorArgs
     * @param  array  $postMethods
     * @return mixed
     */
    public function make($type, array $data, array $ctorArgs = [], array $postMethods = [])
    {
        $factory = $this->factories[$type];
        $className = $factory[0];

        $ctorArgs = array_replace((
            isset($factory[1])
            ? $factory[1]
            : []
        ), $ctorArgs);

        $instance = new $className($ctorArgs);

        foreach ($data as $key => $value) {
            $instance->{$key} = $value;
        }

        foreach ($postMethods as $method => $args) {
            call_user_func_array([$instance, $method], $args);
        }

        return $this->getInjector()->make($className, $parameters);
    }
}
