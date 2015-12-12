<?php

namespace EmbarkNow\ManifoldFactory;

use EmbarkNow\ManifoldFactory\FactoryInterface;

/**
 * Manifold Factory Awareness
 */
trait ManifoldFactoryAwareTrait
{
    /**
     * @var FactoryInterface
     */
    protected $manifoldFactory;

    /**
     * Set a Manifold Factory instance
     * @param FactoryInterface $manifoldFactory
     * @return self
     */
    public function setManifoldFactory(FactoryInterface $manifoldFactory);

    /**
     * Get a Manifold Factory instance
     * @return ManifoldFactoryInterface
     */
    public function getManifoldFactory();
}
