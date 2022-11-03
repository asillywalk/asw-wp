<?php

namespace Sillynet\Action;

use Sillynet\Domain\Customizer\Setting\ShowBackToTop;
use Sillynet\Service\Translator;
use Sillynet\Adretto\Action\FilterHookAction;
use Sillynet\Adretto\Action\InvokerWordpressHookAction;
use Sillynet\Adretto\Theme;
use Sillynet\Adretto\WpTwig\Service\TwigWordpressBridge;

class RegisterTwigGlobalsAction extends InvokerWordpressHookAction implements
    FilterHookAction
{
    public static function getWpHookName(): string
    {
        return TwigWordpressBridge::FILTER_GLOBALS;
    }

    /**
     * @param array{array<string, mixed>} ...$args
     *
     * @return array<string, mixed>
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function __invoke(...$args): array
    {
        /** @var array<string, mixed> $globals */
        $globals = $args[0] ?? [];
        $container = Theme::getInstance()->getContainer();

        $customGlobals = [
            'translator' => $container->get(Translator::class),
            'customizer' => [
                'showBackToTop' => ShowBackToTop::getValue(),
            ],
        ];

        return array_merge($globals, $customGlobals);
    }
}
