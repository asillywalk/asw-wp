<?php

namespace Sillynet\Domain;

use Gebruederheitz\Wordpress\Documentation\DocumentationMenu;
use Gebruederheitz\Wordpress\Documentation\Sections\Shortcodes;

class ThemeDocumentation extends DocumentationMenu
{
    public const MENU_SLUG = 'sillynet-theme-help';
    protected const MENU_TITLE_NAMESPACE = 'sillynet';

    public function __construct(
        ?string $title = null,
        ?string $overridePath = null,
    ) {
        parent::__construct($title, $overridePath);
        Shortcodes::getInstance();
    }
}
