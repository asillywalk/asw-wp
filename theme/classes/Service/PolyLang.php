<?php

namespace Sillynet\Service;

class PolyLang implements Translator
{
    protected const DEFAULT_LANGUAGE = 'de';

    public function exists(): bool
    {
        return self::checkPolylang();
    }

    public function renderLanguageSwitcher(?int $postId): void
    {
        if (isset($postId) && self::checkPolylang('pll_the_languages')) {
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

    public function getCurrentLanguage(): string
    {
        if (self::checkPolylang('pll_current_language')) {
            $languageSlug = pll_current_language();
            if (is_string($languageSlug)) {
                return $languageSlug;
            } else {
                return self::DEFAULT_LANGUAGE;
            }
        } else {
            return self::DEFAULT_LANGUAGE;
        }
    }

    protected static function checkPolylang(
        string $checkedFunction = 'pll__',
    ): bool {
        if (!function_exists($checkedFunction)) {
            error_log(
                'PolyLang is not installed, translation features will not be available.',
            );
            return false;
        }

        return true;
    }
}
