<?php

namespace Sillynet\Responder\Shortcode;

use Sillynet\Action\Shortcode\ShortcodeAction;

class BandcampPlayerShortcodeResponder extends ShortcodeResponder
{
    protected function getTemplateName(): string
    {
        return 'blocks/bandcamp-player';
    }

    /**
     * @inheritDoc
     */
    protected function getData(ShortcodeAction $action): array
    {
        return [];
    }
}
