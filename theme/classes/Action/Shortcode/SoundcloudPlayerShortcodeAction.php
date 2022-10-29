<?php

namespace Sillynet\Action\Shortcode;

use Gebruederheitz\Wordpress\Documentation\Annotations\ShortcodeDocumentation;
use Sillynet\Responder\Shortcode\SoundcloudPlayerShortcodeResponder;

/**
 * @ShortcodeDocumentation(
 *     shortcode="soundcloud-player",
 *     description="Rendert einen Soundcloud iframe-player für den Track / die Playlist mit der angegebenen ID / URL.",
 *     parameters={
 *       "playerUrl": "Die Video- oder Playlist-URL von Soundcloud",
 *       "color": "Eine Highlight-Farbe in Hex-Notation"
 *     },
 *     examples={
 *       "[soundcloud-player playerUrl="OAEbUTNSfMc" /]",
 *     }
 *  )
 */
class SoundcloudPlayerShortcodeAction extends ShortcodeAction
{
    protected static string $shortCodeTag = 'soundcloud-player';

    /**
     * @inheritDoc
     */
    protected function getResponderClassName(): string
    {
        return SoundcloudPlayerShortcodeResponder::class;
    }

    protected function getDefaultAttributes(): array
    {
        return [
            'url' => '',
            'color' => '#40766d',
            'type' => 'track',
        ];
    }
}
