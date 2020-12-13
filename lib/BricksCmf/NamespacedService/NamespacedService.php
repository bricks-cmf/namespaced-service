<?php

/** @copyright Sven Ullmann <kontakt@sumedia-webdesign.de> **/namespace BricksCmf\NamespacedService;

use BricksFramework\Namespaced\NamespacedInterface;

class NamespacedService implements NamespacedServiceInterface
{
    const SERVICE_NAME = 'bricks/namespaced';

    protected $namespaced;

    public function __construct(NamespacedInterface $namespaced)
    {
        $this->namespaced = $namespaced;
    }

    public function getNamespaced() : NamespacedInterface
    {
        return $this->namespaced;
    }

    // for example parse complete namespace name value string

    // for example check if string is valid namespace
}
