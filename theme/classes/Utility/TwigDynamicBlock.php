<?php

namespace Sillynet\Utility;

use Gebruederheitz\GutenbergBlocks\DynamicBlock;
use Gebruederheitz\GutenbergBlocks\PartialRenderer;
use Sillynet\Adretto\Theme;
use Sillynet\Adretto\WpTwig\Service\Twig;

class TwigDynamicBlock extends DynamicBlock
{
    public static function make(
        string $name,
        string $partial,
        array $attributes = null,
        array $requiredAttributes = null,
        string $templateOverridePath = null,
    ): DynamicBlock {
        return new TwigDynamicBlock(
            $name,
            $partial,
            $attributes,
            $requiredAttributes,
            $templateOverridePath,
        );
    }

    /**
     * Callback for the block registration handler, which will render the block
     * with the attributes provided.
     *
     * @param array  $attributes
     * @param string $content
     *
     * @return false|string|null
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function renderBlock(array $attributes = [], string $content = '')
    {
        if (!$this->requiredAttributesArePresent($attributes)) {
            return null;
        }

        /** @var Twig $twig */
        $twig = Theme::getInstance()
            ->getContainer()
            ->get(Twig::class);

        return $twig->render($this->partial, [
            'attributes' => $attributes,
            'content' => $content,
        ]);
    }
}
