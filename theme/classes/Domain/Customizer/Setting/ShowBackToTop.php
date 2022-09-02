<?php

namespace Sillynet\Domain\Customizer\Setting;

use Gebruederheitz\Wordpress\Customizer\InputTypes\CheckboxCustomizerSetting;

class ShowBackToTop extends CheckboxCustomizerSetting
{
    protected static $key = 'sn-show-back-to-top';
    protected static $label = 'Show "Back to top" button in floating side menu';

    public static function getValue(): bool
    {
        return (bool) parent::getValue();
    }
}
