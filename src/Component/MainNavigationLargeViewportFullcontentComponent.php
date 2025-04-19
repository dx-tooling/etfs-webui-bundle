<?php

declare(strict_types=1);

namespace EnterpriseToolingForSymfony\WebuiBundle\Component;

use EnterpriseToolingForSymfony\WebuiBundle\Service\AbstractMainNavigationService;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name    : 'webui|main_navigation|large_viewport|fullcontent',
    template: '@Webui/main_navigation.large_viewport.fullcontent.component.html.twig'
)]
readonly class MainNavigationLargeViewportFullcontentComponent
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
