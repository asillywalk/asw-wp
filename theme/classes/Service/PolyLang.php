<?php

namespace Sillynet\Service;

class PolyLang implements Translator
{
    public function exists(): bool
    {
        return self::checkPolylang();
    }

    public function renderLanguageSwitcher(?int $postId): void
    {
        if (isset($postId) && self::checkPolylang()) {
            pll_the_languages([
                'display_names_as' => 'slug',
                'force_home' => true,
//                'echo' => true,
                'hide_if_no_translation' => false,
                'hide_current' => false,
                'post_id' => $postId,
//                'raw' => false,
            ]);
        }
    }

    protected static function checkPolylang(): bool
    {
        if (!function_exists('pll__')) {
            error_log('PolyLang is not installed, translation features will not be available.');
            return false;
        }

        return true;
    }
}
