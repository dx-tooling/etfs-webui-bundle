<?php

declare(strict_types=1);

namespace EnterpriseToolingForSymfony\WebuiBundle\Service;

use EnterpriseToolingForSymfony\WebuiBundle\Entity\MainNavigationEntry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;

abstract readonly class AbstractMainNavigationService
{
    public function __construct(
        private RouterInterface $router,
        private RequestStack    $requestStack,
        private string          $symfonyEnvironment
    ) {
    }

    abstract public function getPrimaryMainNavigationTitle(): string;

    abstract public function getSecondaryMainNavigationTitle(): string;

    abstract public function getTertiaryMainNavigationTitle(): string;

    /**
     * @return MainNavigationEntry[]
     */
    abstract public function getPrimaryMainNavigationEntries(): array;

    /**
     * @return MainNavigationEntry[]
     */
    abstract protected function getSecondaryMainNavigationEntries(): array;

    /**
     * @return MainNavigationEntry[]
     */
    abstract public function getTertiaryMainNavigationEntries(): array;

    /**
     * The following three functions are only relevant on "fullcontent" pages,
     * and only on the large_viewport variant ("desktop").
     *
     * In this context, there are two presentation versions:
     * a) the secondary main navigation is part of the dropdown
     * b) the secondary main navigation is not part of the dropdown
     *
     * In version a, the main navigation is presented like this:
     *
     * <primary nav entries>                                           <dropdown title><dropdown icon>
     *                                                                 (in opened dropdown:)
     *                                                                 <secondary nav title>
     *                                                                 <secondary nav entries>
     *                                                                 <tertiary nav title>
     *                                                                 <tertiary nav entries>
     *
     * In version b, the main navigation is presented like this:
     *
     * <primary nav entries>                   <secondary nav entries> <dropdown title><dropdown icon>
     *                                                                 (in opened dropdown:)
     *                                                                 <tertiary nav entries>
     */
    abstract public function getDropdownTitle(): string;

    abstract public function getDropdownSvgIcon(): string;

    public function secondaryMainNavigationIsPartOfDropdown(): bool
    {
        return false;
    }

    /**
     * @return MainNavigationEntry[]
     */
    public function getFinalSecondaryMainNavigationEntries(): array
    {
        $entries = $this->getSecondaryMainNavigationEntries();

        if ($this->symfonyEnvironment === 'dev' || $this->symfonyEnvironment === 'test') {
            $entries[] = new MainNavigationEntry(
                'Living Styleguide',
                $this->router->generate('webui.living_styleguide.show'),
                '<path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42" />',
                $this->routeIsActive('webui.living_styleguide.show')
            );
        }

        return $entries;
    }

    private function routeIsActive(string $routeName): bool
    {
        return $this
                ->requestStack
                ->getCurrentRequest()
                ?->attributes
                ->get('_route') === $routeName;
    }

    protected function generateEntry(
        string $title,
        string $routeName = '',
        string $svgIcon = '',
        bool   $isSeparator = false
    ): MainNavigationEntry {
        return new MainNavigationEntry(
            $title,
            $isSeparator ? null : $this->router->generate($routeName),
            $svgIcon,
            $isSeparator ? false : $this->routeIsActive($routeName),
            $isSeparator
        );
    }
}
