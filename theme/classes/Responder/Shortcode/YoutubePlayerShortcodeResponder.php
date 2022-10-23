<?php

namespace Sillynet\Responder\Shortcode;

use Sillynet\Action\Shortcode\ShortcodeAction;
use Sillynet\Utility\Debug;

class YoutubePlayerShortcodeResponder extends ShortcodeResponder
{
    protected static string $templateName = 'blocks/youtube-player';

    /**
     * @inheritDoc
     */
    protected function getData(ShortcodeAction $action): array
    {
        $shortcodeArgs = $action->getData();

        return [
            'youtube' => $shortcodeArgs,
        ];
    }
}
