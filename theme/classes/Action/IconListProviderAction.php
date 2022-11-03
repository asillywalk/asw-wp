<?php

namespace Sillynet\Action;

use Gebruederheitz\GutenbergBlocks\BlockRegistrar;
use Sillynet\Adretto\Action\FilterHookAction;
use Sillynet\Adretto\Action\InvokerWordpressHookAction;
use Sillynet\Adretto\Action\WordpressHookAction;

class IconListProviderAction extends InvokerWordpressHookAction implements
    FilterHookAction
{
    public static function getWpHookName(): string
    {
        return BlockRegistrar::HOOK_SCRIPT_LOCALIZATION_DATA;
    }

    public function __invoke(...$args)
    {
        $localization = $args[0];
        $files = glob(
            get_theme_root() . '/asillywalk/templates/icons/*.html.twig',
        );
        if (!is_array($files)) {
            return $localization;
        }
        array_walk($files, function (&$filename) {
            $filename = preg_replace(
                '/.*\/icons\/(.*)\.html\.twig/',
                '$1',
                $filename,
            );
        });
        $localization['themeIcons'] = $files;

        return $localization;
    }
}
