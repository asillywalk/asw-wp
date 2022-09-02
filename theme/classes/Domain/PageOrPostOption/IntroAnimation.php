<?php

namespace Sillynet\Domain\PageOrPostOption;

use Sillynet\Domain\Metabox\PageHeroMetabox;
use Sillynet\Adretto\SimplePostOptions\AbstractBooleanPageOrPostOption;

class IntroAnimation extends AbstractBooleanPageOrPostOption
{
    protected static string $key = 'sn-has-intro-animation';

    protected static string $inputLabel = 'Show intro animation';

    protected static string $metaboxClassName = PageHeroMetabox::class;
}
