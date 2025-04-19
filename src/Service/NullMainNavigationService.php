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
                "Please create a class that extends this abstract service and implements the required navigation methods.\n\n" .
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
                "    // ... implement other required methods\n" .
                '}',
                AbstractMainNavigationService::class,
                AbstractMainNavigationService::class
            )
        );
    }

    public function getPrimaryMainNavigationTitle(): string
    {
        return 'Primary';
    }

    public function getSecondaryMainNavigationTitle(): string
    {
        return 'Secondary';
    }

    public function getTertiaryMainNavigationTitle(): string
    {
        return 'Tertiary';
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

    public function getDropdownTitle(): string
    {
        return 'Dropdown';
    }

    public function getDropdownSvgIcon(): string
    {
        return '';
    }
}
