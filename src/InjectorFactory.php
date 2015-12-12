<?php

namespace EmbarkNow\ManifoldFactory;

use Auryn\Injector;

use EmbarkNow\Aware\InjectorAwareInterface;
use EmbarkNow\Aware\InjectorAwareTrait;
use EmbarkNow\ManifoldFactory\FactoryInterface;
use EmbarkNow\ManifoldFactory\FactoryBasicsTrait;

/**
 * Injector based Factory implementation
 */
class InjectorFactory implements FactoryInterface
{
    use InjectorAwareTrait;
    use FactoryBasicsTrait {
        addFactoryType as traitAddFactoryType;
        addFactoryTypes as traitAddFactoryTypes;
    }

    /**
     * Accepts the Injector instance
     * @param Injector $injector
     */
    public function __construct(Injector $injector)
    {
        $this->setInjector($injector);
    }

    /**
     * Add a factory definition
     * @param string $key
     * @param mixed $factory
     * @return self
     */
    public function addFactoryType($key, $factory)
    {
        if (!is_array($factory)) {
            throw new InvalidArgumentException("Factory definition provided must be of type array.");
        }

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
            if (!is_array($factory)) {
                throw new InvalidArgumentException("Factory definition provided must be of type array.");
            }

            $this->addFactory($key, $factory);
        }

        return $this;
    }

    /**
     * Make an instance of a stored factory
     * @param  string $type
     * @param  array  $ctorArgs
     * @param  array  $postMethods
     * @return mixed
     */
    public function make($type, array $ctorArgs = [], array $postMethods = [])
    {
        $definition = $this->factories[$type];
        $factory = $definition[0];
        $ctorArgs = array_replace((
            isset($factory[1]) && is_array($factory[1])
            ? $factory[1]
            : []
        ), $ctorArgs);
        $instance = $this->getInjector()->make($factory, $ctorArgs);

        foreach ($postMethods as $method => $args) {
            call_user_func_array([$instance, $method], $args);
        }

        return $instance;

    }
}
