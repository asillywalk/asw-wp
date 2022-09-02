<?php

namespace Sillynet\Domain\PageOrPostOption;

use Sillynet\Domain\Metabox\PageHeroMetabox;
use Sillynet\Adretto\SimplePostOptions\AbstractBooleanPageOrPostOption;

class PageHero extends AbstractBooleanPageOrPostOption
{
    protected static string $key = 'sn-has-page-hero';

    protected static string $inputLabel = 'Show page hero';

    protected static string $metaboxClassName = PageHeroMetabox::class;
}
