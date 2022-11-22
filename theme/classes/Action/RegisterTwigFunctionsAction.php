<?php

namespace Sillynet\Action;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use DateTime;
use Sillynet\Adretto\Action\FilterHookAction;
use Sillynet\Adretto\Action\InvokerWordpressHookAction;
use Sillynet\Adretto\Contracts\Translator;
use Sillynet\Adretto\Theme;
use Sillynet\Adretto\WpTwig\Service\TwigWordpressBridge;

/**
 * @phpstan-import-type FunctionDefinition from TwigWordpressBridge
 */
class RegisterTwigFunctionsAction extends InvokerWordpressHookAction implements
    FilterHookAction
{
    public static function getWpHookName(): string
    {
        return TwigWordpressBridge::FILTER_FUNCTIONS;
    }

    /**
     * @param array{array<FunctionDefinition>} ...$args
     *
     * @return array<FunctionDefinition>
     */
    public function __invoke(...$args): array
    {
        /** @var array<FunctionDefinition> $functions */
        $functions = $args[0] ?? [];

        $customFunctions = [
            [
                'localDate',
                function (DateTime $dateTime, string $locale = null) {
                    if (empty($locale)) {
                        $locale = Theme::getInstance()
                            ->getContainer()
                            ->get(Translator::class)
                            ->getCurrentLanguage();
                    }
                    /** @var CarbonInterface $carbon */
                    $carbon = Carbon::instance($dateTime)->locale($locale);

                    return [
                        'day' => $carbon->isoFormat('dddd'),
                        'date' => $carbon->isoFormat('DD. MMMM YYYY'),
                        'shortDate' => $carbon->isoFormat('DD.MM.'),
                        'year' => $carbon->isoFormat('YYYY'),
                        'full' => $carbon->isoFormat(
                            'dddd, MMMM D YYYY: HH:mm',
                        ),
                        'time' => $carbon->isoFormat('HH:mm'),
                    ];
                },
            ],
            [
                'time',
                function (DateTime $dateTime) {
                    return Carbon::instance($dateTime)->isoFormat(' HH:mm');
                },
            ],
            [
                'dateFromNow',
                function (DateTime $dateTime, string $locale = null) {
                    if (empty($locale)) {
                        $locale = Theme::getInstance()
                            ->getContainer()
                            ->get(Translator::class)
                            ->getCurrentLanguage();
                    }
                    /** @var Carbon $carbon */
                    $carbon = Carbon::instance($dateTime)->locale($locale);
                    return $carbon->diffForHumans(Carbon::now(), [
                        'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW,
                        'options' => CarbonInterface::ONE_DAY_WORDS,
                    ]);
                },
            ],
            [
                'concat_arr',
                function (array $arr) {
                    return implode(',', $arr);
                },
            ],
        ];
        return array_merge($functions, $customFunctions);
    }
}
