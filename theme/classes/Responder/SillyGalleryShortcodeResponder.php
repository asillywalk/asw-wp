<?php

namespace Sillynet\Responder;

use Sillynet\Action\ShortcodeAction;

class SillyGalleryShortcodeResponder extends ShortcodeResponder
{
    protected static string $templateName = 'blocks/silly-gallery';

    protected function getData(ShortcodeAction $action): array
    {
        $shortcodeArguments = $action->getData();
        // demo/test - this shortcode will not need any data (at first)
        return [];
    }
}
