<?php

declare(strict_types=1);

namespace EnterpriseToolingForSymfony\WebuiBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use ValueError;

class EtfsWebuiExtension extends Extension implements PrependExtensionInterface
{
    private BundleInterface $bundle;

    public function __construct(BundleInterface $bundle)
    {
        $this->bundle = $bundle;
    }

    /**
     * @throws Exception
     */
    public function load(
        array            $configs,
        ContainerBuilder $container
    ): void {
        $configuration = $this->getConfiguration($configs, $container);
        $config        = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('services.yaml');

        $container->setParameter('webui.assets.include_tailwind', $config['assets']['include_tailwind']);
        $container->setParameter('webui.assets.include_stimulus', $config['assets']['include_stimulus']);
    }

    public function prepend(ContainerBuilder $container): void
    {
        $projectDir = $container->getParameter('kernel.project_dir');

        if (!is_string($projectDir)) {
            throw new ValueError('Parameter "kernel.project_dir" must be a string, ' . gettype($projectDir) . ' given. ');
        }

        // Get absolute bundle root path
        $bundlePath = Path::makeAbsolute(
            $this->bundle->getPath(),
            $projectDir
        );

        // Add doctrine mapping configuration automatically
        $container->prependExtensionConfig(
            'doctrine', [
                'orm' => [
                    'mappings' => [
                        'WebuiBundle' => [
                            'type'      => 'attribute',
                            'is_bundle' => false,
                            'prefix'    => 'EnterpriseToolingForSymfony\WebuiBundle',
                            'dir'       => $bundlePath . '/src',
                        ],
                    ],
                ],
            ]
        );

        // Add Twig paths
        $container->prependExtensionConfig('twig', [
            'paths' => [
                // This makes templates in this bundle available via '@Webui' in apps
                __DIR__ . '/../../templates' => 'Webui',
            ],
        ]);

        $container->prependExtensionConfig('framework', [
            'asset_mapper' => [
                'paths' => [
                    __DIR__ . '/../../assets' => '@enterprise-tooling-for-symfony/webui',
                ],
            ],
        ]);

        // Add asset mapper paths
        /*
        $container->prependExtensionConfig('framework', [
            'asset_mapper' => [
                'paths' => [
                    __DIR__ . '/../../assets' => '@webui',
                ],
            ],
        ]);
        */
    }
}
