<?php

namespace Sillynet\Domain\PageOrPostOption;

use Sillynet\Domain\Metabox\PageHeroMetabox;
use Sillynet\Adretto\SimplePostOptions\AbstractBooleanPageOrPostOption;

class IntroAnimation extends AbstractBooleanPageOrPostOption
{
    protected static function getKey(): string
    {
        return 'sn-has-intro-animation';
    }

    protected static function getInputLabel(): string
    {
        return 'Show intro animation';
    }

    protected static function getMetaboxClassName(): string
    {
        return PageHeroMetabox::class;
    }
}
