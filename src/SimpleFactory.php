<?php

namespace EmbarkNow\ManifoldFactory;

use EmbarkNow\ManifoldFactory\FactoryInterface;
use EmbarkNow\ManifoldFactory\FactoryBasicsTrait;

/**
 * Simple String based Factory implementation
 */
class SimpleFactory implements FactoryInterface
{
    use FactoryBasicsTrait;

    /**
     * Make an instance of a stored factory
     * @param  string $type
     * @param  array  $ctorArgs
     * @param  array  $postMethods
     * @return mixed
     */
    public function make($type, array $ctorArgs = [], array $postMethods = [])
    {
        $factory = $this->factories[$type];
        $instance = new $factory($ctorArgs);

        foreach ($postMethods as $method => $args) {
            call_user_func_array([$instance, $method], $args);
        }

        return $instance;
    }
}
