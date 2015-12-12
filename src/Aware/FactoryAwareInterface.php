<?php

namespace EmbarkNow\ManifoldFactory;

use EmbarkNow\ManifoldFactory\FactoryInterface;

/**
 * Manifold Factory Awareness
 */
interface ManifoldFactoryAwareInterface
{
    /**
     * Set a Manifold Factory instance
     * @param FactoryInterface $manifoldFactory
     * @return self
     */
    public function setManifoldFactory(FactoryInterface $manifoldFactory);

    /**
     * Get a Manifold Factory instance
     * @return FactoryInterface
     */
    public function getManifoldFactory();
}
