<?php

namespace Sillynet\Domain\Customizer;

use Gebruederheitz\Wordpress\Customizer\AbstractCustomizerSettingsHandler;
use Sillynet\Domain\Customizer\Setting\ShowBackToTop;

class GeneralSettings extends TwigRegisteredCustomizerSettingsHandler
{
    protected function getTwigGlobalNames(): array
    {
        return [
            ShowBackToTop::class => 'showBackToTop',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getSettings(): array
    {
        return [new ShowBackToTop()];
    }
}
