<?php

declare(strict_types=1);

namespace EnterpriseToolingForSymfony\WebuiBundle\Service;

use LogicException;

readonly class NullMainNavigationService extends AbstractMainNavigationService
{
    public function __construct()
    {
        throw new LogicException(
            sprintf(
                "No implementation of %s found.\n\n" .
                "The WebuiBundle requires you to provide a service class that extends %s.\n" .
                "Please create a class that extends this abstract service and implements the required navigation methods (getPrimaryMainNavigationEntries, getBrandLogoHtml, etc.).\n\n" .
                "Example:\n" .
                "namespace App\\Service;\n\n" .
                "use EnterpriseToolingForSymfony\\WebuiBundle\\Service\\AbstractMainNavigationService;\n\n" .
                "class MainNavigationService extends AbstractMainNavigationService\n" .
                "{\n" .
                "    public function getPrimaryMainNavigationEntries(): array\n" .
                "    {\n" .
                "        // Implement your navigation logic here\n" .
                "        return [];\n" .
                "    }\n" .
                "    public function getBrandLogoHtml(): string { return \'<a href=\"\/\">MyApp</a>\'; }\n" .
                "    // ... implement other required methods\n" .
                '}',
                AbstractMainNavigationService::class,
                AbstractMainNavigationService::class
            )
        );
    }

    public function getPrimaryMainNavigationTitle(): string
    {
        return '';
    }

    public function getSecondaryMainNavigationTitle(): string
    {
        return '';
    }

    public function getTertiaryMainNavigationTitle(): string
    {
        return '';
    }

    public function getPrimaryMainNavigationEntries(): array
    {
        return [];
    }

    public function getSecondaryMainNavigationEntries(): array
    {
        return [];
    }

    public function getTertiaryMainNavigationEntries(): array
    {
        return [];
    }

    public function getBrandLogoHtml(): string
    {
        return '<span class="text-xl font-bold text-gray-900 dark:text-white">Logo</span>';
    }

    public function getDropdownTitle(): string
    {
        return '';
    }

    public function getDropdownSvgIcon(): string
    {
        return '';
    }
}
