<?php

namespace Sillynet\Action\Editor;

use Sillynet\Adretto\Action\Action;
use Sillynet\Adretto\Action\CustomAction;
use Sillynet\Utility\TwigDynamicBlock;

class RegisterIconBlockAction implements Action, CustomAction
{
    public function __construct()
    {
        TwigDynamicBlock::make(
            'sillynet/icon',
            'blocks/icon',
            [
                'iconType' => [
                    'type' => 'string',
                ],
                'themeIcon' => [
                    'type' => 'string',
                    'default' => '',
                ],
                'faIcon' => [
                    'type' => 'string',
                    'default' => '',
                ],
                'mediaID' => [
                    'type' => 'number',
                    'default' => null,
                ],
                'mediaURL' => [
                    'type' => 'string',
                    'default' => '',
                ],
                'iconSize' => [
                    'type' => 'number',
                    'default' => 3,
                ],
            ],
            ['iconType'],
        )->register();
    }
}
