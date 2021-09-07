<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

class CmsUsageInProjectEnums extends AbstractEnums
{
    public const YES_CLASSIC = 1;
    public const YES_HEADLESS = 2;
    public const NO = 3;

    protected $choices = [
        self::YES_CLASSIC => 'Oui un CMS classique (Wordress, Drupal, ...)',
        self::YES_HEADLESS => 'Oui un CMS headless (Directus, Netlify, ...),',
        self::NO => 'Non',
    ];
}
