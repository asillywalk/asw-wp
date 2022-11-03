<?php

namespace Sillynet\Domain\PageOrPostOption;

use Sillynet\Domain\Metabox\PageHeroMetabox;
use Sillynet\Adretto\SimplePostOptions\AbstractBooleanPageOrPostOption;

class PageHero extends AbstractBooleanPageOrPostOption
{
    protected static function getKey(): string
    {
        return 'sn-has-page-hero';
    }

    protected static function getInputLabel(): string
    {
        return 'Show page hero';
    }

    protected static function getMetaboxClassName(): string
    {
        return PageHeroMetabox::class;
    }
}
