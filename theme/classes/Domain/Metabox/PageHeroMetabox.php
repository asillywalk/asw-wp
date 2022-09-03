<?php

namespace Sillynet\Domain\Metabox;

use Sillynet\Adretto\SimplePostOptions\AbstractMetabox;

class PageHeroMetabox extends AbstractMetabox
{
    public static string $key = 'sillynet-metabox-page-hero';

    protected static string $title = 'Page hero';

    //    protected static string $context = "side";

    //    protected static array $postTypes = ["post", "page"];
}
