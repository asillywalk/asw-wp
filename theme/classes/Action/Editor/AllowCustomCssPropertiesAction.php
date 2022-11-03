<?php

namespace Sillynet\Action\Editor;

use Sillynet\Adretto\Action\FilterHookAction;
use Sillynet\Adretto\Action\InvokerWordpressHookAction;

class AllowCustomCssPropertiesAction
    extends InvokerWordpressHookAction
    implements FilterHookAction
{
    /**
     * @inheritDoc
     */
    public static function getWpHookName(): string
    {
        return 'safe_style_css';
    }

    /**
     * @inheritDoc
     */
    public function __invoke(...$args)
    {
        $allowedAttributes = $args[0];

        $allowedAttributes[] = '--sn-icon-size';

        return $allowedAttributes;
    }
}
