<?php

namespace Sillynet\Action\Shortcode;

use Sillynet\Responder\Shortcode\InstagramEmbedShortcodeResponder;

/**
 * @ShortcodeDocumentation(
 *     shortcode="instagram",
 *     description="Rendert einen Instagram-Post",
 *     parameters={
 *       "id": "Post-, Page- oder Story-ID"
 *     },
 *     examples={
 *       "[instagram id="OAEbUTNSfMc" /]",
 *     }
 *  )
 */
class InstagramEmbedShortcodeAction extends ShortcodeAction
{

    protected function getShortcodeTag(): string
    {
        return 'instagram';
    }

    /**
     * @inheritDoc
     */
    protected function getResponderClassName(): string
    {
        return InstagramEmbedShortcodeResponder::class;
    }

    protected function getDefaultAttributes(): array
    {
        return [
            'id' => '',
        ];
    }
}
