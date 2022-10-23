<?php

namespace Sillynet\Action\Shortcode;

use Gebruederheitz\Wordpress\Documentation\Annotations\ShortcodeDocumentation;
use Sillynet\Responder\Shortcode\YoutubePlayerShortcodeResponder;

/**
 * @ShortcodeDocumentation(
 *     shortcode="youtube-player",
 *     description="Rendert einen Youtube iframe-player für das Video / die Playlist mit der angegebenen ID.",
 *     parameters={
 *       "id": "Die Video- oder Playlist-ID von Youtube"
 *     },
 *     examples={
 *       "[youtube-player id="OAEbUTNSfMc" /]",
 *     }
 *  )
 */
class YoutubePlayerShortcodeAction extends ShortcodeAction
{
    protected static string $shortCodeTag = 'youtube-player';

    /**
     * @inheritDoc
     */
    protected function getResponderClassName(): string
    {
        return YoutubePlayerShortcodeResponder::class;
    }

    protected function getDefaultAttributes(): array
    {
        return [
            'id' => '',
        ];
    }
}
