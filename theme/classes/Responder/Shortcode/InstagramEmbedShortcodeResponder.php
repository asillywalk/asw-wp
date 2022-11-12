<?php

namespace Sillynet\Responder\Shortcode;

use Sillynet\Action\Shortcode\ShortcodeAction;

class InstagramEmbedShortcodeResponder extends ShortcodeResponder
{
    protected function getTemplateName(): string
    {
        return 'blocks/instagram-embed';
    }

    /**
     * @inheritDoc
     */
    protected function getData(ShortcodeAction $action): array
    {
        $shortcodeArgs = $action->getData();

        return [
            'instagram' => $shortcodeArgs,
        ];
    }
}
