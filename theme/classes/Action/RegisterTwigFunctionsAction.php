<?php

namespace Sillynet\Action;

use Sillynet\Adretto\Action\FilterHookAction;
use Sillynet\Adretto\Action\InvokerWordpressHookAction;
use Sillynet\Adretto\WpTwig\Service\TwigWordpressBridge;

class RegisterTwigFunctionsAction extends InvokerWordpressHookAction implements
    FilterHookAction
{
    public const WP_HOOK = TwigWordpressBridge::FILTER_FUNCTIONS;

    public function __invoke(...$args): array
    {
        $functions = $args[0] ?? [];
        return $functions;
    }
}
