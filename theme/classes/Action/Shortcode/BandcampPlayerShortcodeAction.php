<?php

namespace Sillynet\Action\Shortcode;

use Gebruederheitz\Wordpress\Documentation\Annotations\ShortcodeDocumentation;
use Sillynet\Responder\Shortcode\BandcampPlayerShortcodeResponder;

/**
 * @ShortcodeDocumentation(
 *     shortcode="bandcamp-player",
 *     description="Rendert einen Bandcamp Media-Player für den A Silly Walk - Account.",
 *     parameters={},
 *     examples={
 *       "[bandcamp-player /]",
 *     }
 *  )
 */
class BandcampPlayerShortcodeAction extends ShortcodeAction
{
    protected function getShortCodeTag(): string
    {
        return 'bandcamp-player';
    }

    /**
     * @inheritDoc
     */
    protected function getResponderClassName(): string
    {
        return BandcampPlayerShortcodeResponder::class;
    }
}
