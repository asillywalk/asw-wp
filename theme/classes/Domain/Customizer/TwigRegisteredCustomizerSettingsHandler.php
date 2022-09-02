<?php

namespace Sillynet\Domain\Customizer;

use Gebruederheitz\Wordpress\Customizer\AbstractCustomizerSettingsHandler;
use Gebruederheitz\Wordpress\Customizer\CustomizerSetting;
use Sillynet\Adretto\WpTwig\Service\TwigWordpressBridge;

abstract class TwigRegisteredCustomizerSettingsHandler extends
    AbstractCustomizerSettingsHandler
{
    public function __construct()
    {
        parent::__construct();
        add_filter(TwigWordpressBridge::FILTER_GLOBALS, [$this, 'onFilterTwigGlobals']);
    }

    public function onFilterTwigGlobals(array $globals): array
    {
        $customGlobals = [];

        foreach ($this->getTwigGlobalNames() as $className => $settingName) {
            $value = $className::getValue();
            $customGlobals[$settingName] = $value;
        }

        return array_merge($globals, ['customizer' => $customGlobals]);
    }

    /**
     * @return array<class-string<CustomizerSetting>, string>
     */
    abstract protected function getTwigGlobalNames(): array;

    /**
     * @inheritDoc
     */
    abstract protected function getSettings(): array;
}
