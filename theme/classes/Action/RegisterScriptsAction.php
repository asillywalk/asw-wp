<?php

namespace Sillynet\Action;

use Gebruederheitz\GutenbergBlocks\BlockRegistrar;
use Sillynet\Adretto\Action\ActionHookAction;
use Sillynet\Adretto\Action\InvokerWordpressHookAction;
use Sillynet\Adretto\Theme;
use Sillynet\Service\PolyLang;

class RegisterScriptsAction extends InvokerWordpressHookAction implements
    ActionHookAction
{
    public const WP_HOOK = 'wp_enqueue_scripts';

    /**
     * @inheritDoc
     */
    public function __invoke(...$args)
    {
        wp_localize_script('sillynet-scripts', 'sillynet', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'locale' => Theme::getInstance()
                ->getContainer()
                ->get(PolyLang::class)
                ->getCurrentLanguage(),
        ]);

        wp_enqueue_script(
            'sillynet-scripts',
            get_theme_file_uri('/js/main.js'),
            [],
            Theme::getThemeVersion(),
            true,
        );
    }
}
