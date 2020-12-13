<?php

/** @copyright Sven Ullmann <kontakt@sumedia-webdesign.de> **/namespace BricksCmf\NamespacedService\Bootstrap;

use BricksCmf\NamespacedService\Bootstrap\Initializer\NamespacedInitializer;
use BricksCmf\NamespacedService\NamespacedService;
use BricksFramework\Bootstrap\BootstrapInterface;
use BricksFramework\Bootstrap\Module\AbstractModule;
use BricksFramework\Environment\EnvironmentInterface;
use BricksFramework\Namespaced\NamespacedInterface;
use BricksFramework\Namespaced\NamespaceName;
use BricksFramework\Namespaced\NamespaceValue;

class Module extends AbstractModule
{
    /** @var BootstrapInterface */
    protected $bootstrap;

    /** @var NamespacedInterface */
    protected $namespaced;

    public function getInitializerClasses(): array
    {
        return [
            NamespacedInitializer::class
        ];
    }

    public function preBootstrap(BootstrapInterface $bootstrap): void
    {
        $this->bootstrap = $bootstrap;
        $this->namespaced = $bootstrap->getService(NamespacedService::SERVICE_NAME)->getNamespaced();
        $this->addEnvironmentNamespaces();
    }

    protected function addEnvironmentNamespaces()
    {
        /** @var EnvironmentInterface $environment */
        $environment = $this->bootstrap->getEnvironment();
        $name = new NamespaceName('dev');
        $name->setCurrentNamespace(['env' => $environment->getDefaultEnvironment()]);
        foreach ($environment->getEnvironments() as $env) {
            $value = new NamespaceValue('env', $env);
            $name->getNamespaceValueCollection()->push($value);
        }
        $name->setCurrentNamespace(['env' => $environment->getCurrentEnvironment()]);
        $this->namespaced->getNamespaceNameCollection()->push($name);
    }
}
