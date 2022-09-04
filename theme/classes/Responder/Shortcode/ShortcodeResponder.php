<?php

namespace Sillynet\Responder\Shortcode;

use Sillynet\Action\Shortcode\ShortcodeAction;
use Sillynet\Adretto\Action\Action;
use Sillynet\Adretto\WpTwig\Responder\TwigResponder;

use function i;

abstract class ShortcodeResponder extends TwigResponder
{
    protected static string $templateName = '';

    /**
     * @param ShortcodeAction $action
     */
    public function respond(Action $action): string
    {
        $templateData = $this->getData($action);

        ob_start();
        i(static::$templateName, $templateData);

        return ob_get_clean() ?: '';
    }

    /**
     * @param ShortcodeAction $action
     *
     * @return array<string, mixed>
     */
    abstract protected function getData(ShortcodeAction $action): array;
}
