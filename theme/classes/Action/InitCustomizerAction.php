<?php

namespace Sillynet\Action;

use Gebruederheitz\Wordpress\Customizer\CustomizerSection;
use Gebruederheitz\Wordpress\Customizer\CustomizerSettings;
use Sillynet\Domain\Customizer\GeneralSettings;
use Sillynet\Adretto\Action\CustomAction;

class InitCustomizerAction implements CustomAction
{
    public function __construct()
    {
        if (is_customize_preview()) {
            $this->handle();
        }
    }

    public function handle(): void
    {
        new CustomizerSettings('Theme-Einstellungen', 'sillynet');
        new CustomizerSection(
            'sn-customizer-general',
            'Allgemeine Einstellungen',
            null,
            [new GeneralSettings()],
        );
    }
}
