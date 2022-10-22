<?php

namespace Sillynet\Responder\Shortcode;

use Sillynet\Action\Shortcode\ShortcodeAction;

class YoutubePlayerShortcodeResponder extends ShortcodeResponder
{
    protected static string $templateName = 'blocks/youtube-player';

    /**
     * @inheritDoc
     */
    protected function getData(ShortcodeAction $action): array
    {
        $shortcodeArgs = $action->getData();
        $parsedArgs = shortcode_atts([
            'id' => '',
        ], $shortcodeArgs);

        return [
            'youtube' => [
                'id' => $parsedArgs['id'],
            ],
        ];
    }
}
