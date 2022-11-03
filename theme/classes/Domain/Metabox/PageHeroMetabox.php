<?php

namespace Sillynet\Domain\Metabox;

use Sillynet\Adretto\SimplePostOptions\AbstractMetabox;

class PageHeroMetabox extends AbstractMetabox
{
    //    protected static string $context = "side";

    //    protected static array $postTypes = ["post", "page"];

    public function getKey(): string
    {
        return 'sillynet-metabox-page-hero';
    }

    public function getTitle(): string
    {
        return 'Page hero';
    }
}
