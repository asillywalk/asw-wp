<?php

namespace Sillynet\Action;

use Sillynet\Adretto\Action\ActionHookAction;
use Sillynet\Adretto\Action\InvokerWordpressHookAction;
use Sillynet\Adretto\Theme;

class ThemeStylesAction extends InvokerWordpressHookAction implements
    ActionHookAction
{
    public static function getWpHookName(): string
    {
        return 'wp_enqueue_scripts';
    }

    public function __invoke(...$args): void
    {
        wp_enqueue_style(
            'main-styles',
            get_stylesheet_uri(),
            [],
            Theme::getThemeVersion(),
        );
    }
}
