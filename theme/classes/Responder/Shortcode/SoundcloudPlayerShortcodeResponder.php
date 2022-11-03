<?php

namespace Sillynet\Responder\Shortcode;

use Sillynet\Action\Shortcode\ShortcodeAction;
use Sillynet\Utility\Debug;

class SoundcloudPlayerShortcodeResponder extends ShortcodeResponder
{
    protected function getTemplateName(): string
    {
        return 'blocks/soundcloud-player';
    }

    /**
     * @inheritDoc
     */
    protected function getData(ShortcodeAction $action): array
    {
        $shortcodeArgs = $action->getData();

        return [
            'soundcloud' => $shortcodeArgs,
        ];
    }
}
