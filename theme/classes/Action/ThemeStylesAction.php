<?php

namespace Sillynet\Action;

use Sillynet\Adretto\Action\ActionHookAction;
use Sillynet\Adretto\Action\WordpressHookAction;
use Sillynet\Adretto\Theme;

class ThemeStylesAction extends WordpressHookAction implements ActionHookAction
{
    public const WP_HOOK = 'wp_enqueue_scripts';

    public function __invoke(): void
    {
        wp_enqueue_style(
            'main-styles',
            get_stylesheet_uri(),
            [],
            Theme::getThemeVersion(),
        );
    }

    public function getHandler(): callable
    {
        return $this;
    }

    public function getData(): array
    {
        return [];
    }
}
