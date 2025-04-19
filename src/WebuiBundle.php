<?php

namespace EnterpriseToolingForSymfony\WebuiBundle;

use EnterpriseToolingForSymfony\WebuiBundle\DependencyInjection\Compiler\MainNavigationServicePass;
use EnterpriseToolingForSymfony\WebuiBundle\DependencyInjection\EtfsWebuiExtension;
use LogicException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use function dirname;

class WebuiBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        if (!class_exists('Symfony\Bundle\FrameworkBundle\FrameworkBundle')) {
            throw new LogicException('The Symfony FrameworkBundle is required to use the WebuiBundle.');
        }

        $container->addCompilerPass(new MainNavigationServicePass());
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new EtfsWebuiExtension($this);
        }

        if ($this->extension === false) {
            return null;
        }

        return $this->extension;
    }

    public function getPath(): string
    {
        return dirname(__DIR__);
    }
}
