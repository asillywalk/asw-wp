<?php

namespace Sillynet\Action\Shortcode;

use Gebruederheitz\Wordpress\Documentation\Traits\withShortcodeDocumentation;
use Psr\Container\ContainerInterface;
use Sillynet\Action\Shortcode\SillyGalleryShortcodeAction;
use Sillynet\Responder\Shortcode\ShortcodeResponder;
use Sillynet\Adretto\Action\CustomAction;

use function add_shortcode;

abstract class ShortcodeAction implements CustomAction
{
    use withShortcodeDocumentation;

    private ContainerInterface $container;

    /**
     * @var array<mixed>|string
     */
    private array|string $shortcodeArguments = [];

    abstract protected function getShortcodeTag(): string;

    public function __construct(ContainerInterface $c)
    {
        $this->container = $c;
        add_shortcode($this->getShortcodeTag(), [$this, 'handle']);
        self::addDocumentation();
    }

    /**
     * @return array<mixed>
     */
    public function getData(): array
    {
        return is_array($this->shortcodeArguments)
            ? $this->shortcodeArguments
            : [];
    }

    /**
     * @param string|array<string, mixed> $shortcodeArguments
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function handle(array|string $shortcodeArguments): string
    {
        /** @var ShortcodeResponder $responder */
        $responder = $this->container->get($this->getResponderClassName());
        $shortcodeArguments = is_array($shortcodeArguments)
            ? $shortcodeArguments
            : [];
        $this->shortcodeArguments = shortcode_atts(
            $this->getDefaultAttributes(),
            $shortcodeArguments,
            $this->getShortcodeTag(),
        );
        $this->onBeforeRespond();
        return $responder->respond($this);
    }

    /**
     * @return class-string<ShortcodeResponder>
     */
    abstract protected function getResponderClassName(): string;

    /**
     * @return array<string, mixed>
     */
    protected function getDefaultAttributes(): array
    {
        return [];
    }

    protected function onBeforeRespond(): void
    {
    }
}
