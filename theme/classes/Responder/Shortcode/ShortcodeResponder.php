<?php

namespace Sillynet\Responder\Shortcode;

use Sillynet\Action\Shortcode\ShortcodeAction;
use Sillynet\Adretto\Action\Action;
use Sillynet\Adretto\WpTwig\Responder\TwigResponder;

use function i;

/**
 * @extends TwigResponder<ShortcodeAction>
 */
abstract class ShortcodeResponder extends TwigResponder
{
    /**
     * @param ShortcodeAction $action
     */
    public function respond(Action $action): string
    {
        $templateData = $this->getData($action);

        ob_start();
        i($this->getTemplateName(), $templateData);

        return ob_get_clean() ?: '';
    }

    abstract protected function getTemplateName(): string;

    /**
     * @param ShortcodeAction $action
     *
     * @return array<string, mixed>
     */
    abstract protected function getData(ShortcodeAction $action): array;
}
