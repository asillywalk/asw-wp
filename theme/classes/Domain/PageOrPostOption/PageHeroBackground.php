<?php

namespace Sillynet\Domain\PageOrPostOption;

use Sillynet\Domain\Metabox\PageHeroMetabox;
use Sillynet\Adretto\SimplePostOptions\AbstractBooleanPageOrPostOption;

class PageHeroBackground extends AbstractBooleanPageOrPostOption
{
    protected static string $key = 'sn-has-page-hero-background';

    protected static string $inputLabel = 'Show background image';

    protected static string $metaboxClassName = PageHeroMetabox::class;
}
