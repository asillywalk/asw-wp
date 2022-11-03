<?php

namespace Sillynet\Domain\PageOrPostOption;

use Sillynet\Domain\Metabox\PageHeroMetabox;
use Sillynet\Adretto\SimplePostOptions\AbstractBooleanPageOrPostOption;

class PageHeroBackground extends AbstractBooleanPageOrPostOption
{
    protected static function getKey(): string
    {
        return 'sn-has-page-hero-background';
    }

    protected static function getInputLabel(): string
    {
        return 'Show background image';
    }

    protected static function getMetaboxClassName(): string
    {
        return PageHeroMetabox::class;
    }
}
