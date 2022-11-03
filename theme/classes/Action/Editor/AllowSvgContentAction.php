<?php

namespace Sillynet\Action\Editor;

use Sillynet\Adretto\Action\FilterHookAction;
use Sillynet\Adretto\Action\InvokerWordpressHookAction;

class AllowSvgContentAction extends InvokerWordpressHookAction implements
    FilterHookAction
{
    public const ARGUMENT_COUNT = 2;

    public static function getWpHookName(): string
    {
        return 'wp_kses_allowed_html';
    }

    /**
     * @inheritDoc
     */
    public function __invoke(...$args)
    {
        $tags = $args[0];

        $tags['svg'] = [
            'xmlns' => [],
            'fill' => [],
            'viewbox' => [],
            'role' => [],
            'aria-hidden' => [],
            'focusable' => [],
            'data-prefix' => [],
            'data-icon' => [],
            'class' => [],
        ];
        $tags['path'] = [
            'd' => [],
            'fill' => [],
        ];

        return $tags;
    }
}
