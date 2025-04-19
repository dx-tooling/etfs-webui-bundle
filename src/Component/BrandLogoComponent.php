<?php

declare(strict_types=1);

namespace EnterpriseToolingForSymfony\WebuiBundle\Component;

use EnterpriseToolingForSymfony\WebuiBundle\Service\AbstractMainNavigationService;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'webui|brand_logo',
    template: '@Webui/brand_logo.component.html.twig'
)]
readonly class BrandLogoComponent
{
    public function __construct(
        private AbstractMainNavigationService $mainNavigationService
    ) {
    }

    public function getMainNavigationService(): AbstractMainNavigationService
    {
        return $this->mainNavigationService;
    }
}
