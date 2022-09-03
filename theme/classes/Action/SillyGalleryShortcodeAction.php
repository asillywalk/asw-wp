<?php

namespace Sillynet\Action;

use Gebruederheitz\Wordpress\Documentation\Annotations\ShortcodeDocumentation;
use Sillynet\Responder\SillyGalleryShortcodeResponder;

/**
 * @ShortcodeDocumentation(
 *     shortcode="silly-gallery",
 *     description="Rendert die &quot;Silly Gallery&quot;, mit animierten Bildern aller Bandmitglieder.",
 *     parameters={},
 *     examples={
 *       "[silly-gallery /]",
 *     }
 *  )
 */
class SillyGalleryShortcodeAction extends ShortcodeAction
{
    protected static string $shortCodeTag = 'silly-gallery';

    protected function getResponderClassName(): string
    {
        return SillyGalleryShortcodeResponder::class;
    }
}
