<?php

namespace Sillynet\Responder\Shortcode;

use Sillynet\Action\Shortcode\ShortcodeAction;
use Sillynet\Utility\Debug;

class SoundcloudPlayerShortcodeResponder extends ShortcodeResponder
{
    protected static string $templateName = 'blocks/soundcloud-player';

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
