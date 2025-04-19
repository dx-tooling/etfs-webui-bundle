<?php

declare(strict_types=1);

namespace EnterpriseToolingForSymfony\WebuiBundle\Entity;

readonly class MainNavigationEntry
{
    public string $title;
    public ?string $url;
    public string $iconSvg;
    public bool $isActive;
    public bool $isSeparator;

    public function __construct(
        string  $title,
        ?string $url,
        string  $iconSvg,
        bool    $isActive,
        bool    $isSeparator = false
    ) {
        $this->title       = $title;
        $this->url         = $url;
        $this->iconSvg     = $iconSvg;
        $this->isActive    = $isActive;
        $this->isSeparator = $isSeparator;
    }

    public static function createSeparator(): self
    {
        return new self('', null, '', false, true);
    }
}
