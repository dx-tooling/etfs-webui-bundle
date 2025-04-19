<?php

declare(strict_types=1);

namespace EnterpriseToolingForSymfony\WebuiBundle\DependencyInjection\Compiler;

use EnterpriseToolingForSymfony\WebuiBundle\Service\AbstractMainNavigationService;
use EnterpriseToolingForSymfony\WebuiBundle\Service\NullMainNavigationService;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\LogicException;

class MainNavigationServicePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $implementations = [];

        // Find all service definitions
        foreach ($container->getDefinitions() as $serviceId => $definition) {
            $class = $definition->getClass();

            if (!$class) {
                continue;
            }

            // Check if this class extends our abstract service, but is not our null implementation
            if (is_subclass_of($class, AbstractMainNavigationService::class)
                && $class !== NullMainNavigationService::class
            ) {
                $implementations[$serviceId] = $class;
            }
        }

        if (count($implementations) > 1) {
            $implementationsList = array_map(
                fn (string $serviceId, string $class) => sprintf('- %s (%s)', $class, $serviceId),
                array_keys($implementations),
                array_values($implementations)
            );

            throw new LogicException(
                sprintf(
                    "Multiple implementations of %s found.\n\n" .
                    "The WebuiBundle requires exactly one service class that extends %s, but found %d implementations:\n\n%s\n\n" .
                    "Please ensure only one implementation exists, or explicitly configure which implementation to use by adding this to your services.yaml:\n\n" .
                    "%s: '@your_chosen_service_id'",
                    AbstractMainNavigationService::class,
                    AbstractMainNavigationService::class,
                    count($implementations),
                    implode("\n", $implementationsList),
                    AbstractMainNavigationService::class
                )
            );
        }

        if (empty($implementations)) {
            // Register the null implementation
            $nullServiceId = 'webui.service.null_main_navigation';
            $container->setDefinition($nullServiceId, new Definition(NullMainNavigationService::class));
            $container->setAlias(AbstractMainNavigationService::class, $nullServiceId);
        } else {
            // Use the only implementation found
            $container->setAlias(
                AbstractMainNavigationService::class,
                array_key_first($implementations)
            );
        }
    }
}
