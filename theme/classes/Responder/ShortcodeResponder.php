<?php

namespace Sillynet\Responder;

use Sillynet\Action\ShortcodeAction;
use Sillynet\Adretto\Action\Action;
use Sillynet\Adretto\WpTwig\Responder\TwigResponder;

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

        return ob_get_clean();
    }

    abstract protected function getData(ShortcodeAction $action): array;
}
