<?php

namespace Sillynet\Action;

use Sillynet\Adretto\Action\FilterHookAction;
use Sillynet\Adretto\Action\InvokerWordpressHookAction;
use Sillynet\Adretto\WpTwig\Service\TwigWordpressBridge;

/**
 * @phpstan-import-type FunctionDefinition from TwigWordpressBridge
 */
class RegisterTwigFunctionsAction extends InvokerWordpressHookAction implements
    FilterHookAction
{
    public const WP_HOOK = TwigWordpressBridge::FILTER_FUNCTIONS;

    /**
     * @param array{array<FunctionDefinition>} ...$args
     *
     * @return array<FunctionDefinition>
     */
    public function __invoke(...$args): array
    {
        /** @var array<FunctionDefinition> $functions */
        $functions = $args[0] ?? [];
        return $functions;
    }
}
