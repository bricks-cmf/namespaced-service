<?php

/** @copyright Sven Ullmann <kontakt@sumedia-webdesign.de> **/namespace BricksCmf\NamespacedService\Bootstrap\Initializer;

use BricksCmf\NamespacedService\NamespacedService;
use BricksFramework\Bootstrap\BootstrapInterface;
use BricksFramework\Bootstrap\Initializer\AbstractInitializer;

class NamespacedInitializer extends AbstractInitializer
{
    public function initialize(BootstrapInterface $bootstrap): void
    {
        if (in_array(NamespacedService::SERVICE_NAME, $bootstrap->getServices())) {
            return;
        }

        $namespaced = $bootstrap->getInstance('BricksFramework\\Namespaced\\Namespaced');
        $namespacedService = $bootstrap->getInstance('BricksCmf\\NamespacedService\\NamespacedService',  [
            $namespaced
        ]);
        $bootstrap->setService(NamespacedService::SERVICE_NAME, $namespacedService);
    }

    public function getPriority(): int
    {
        return -9700;
    }
}
