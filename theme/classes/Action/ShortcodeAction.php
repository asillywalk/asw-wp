<?php

namespace Sillynet\Action;

use Gebruederheitz\Wordpress\Documentation\Traits\withShortcodeDocumentation;
use Psr\Container\ContainerInterface;
use Sillynet\Responder\ShortcodeResponder;
use Sillynet\Adretto\Action\CustomAction;

abstract class ShortcodeAction implements CustomAction
{
    use withShortcodeDocumentation;

    protected static string $shortCodeTag = '';

    private ContainerInterface $container;

    /**
     * @var array<mixed>|string
     */
    private array|string $shortcodeArguments = [];

    public function __construct(ContainerInterface $c)
    {
        $this->container = $c;
        add_shortcode(static::$shortCodeTag, [$this, 'handle']);
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
     * @param array<string, mixed> $shortcodeArguments
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function handle(array $shortcodeArguments): string
    {
        /** @var ShortcodeResponder $responder */
        $responder = $this->container->get($this->getResponderClassName());
        $this->shortcodeArguments = $shortcodeArguments;
        return $responder->respond($this);
    }

    /**
     * @return class-string<ShortcodeResponder>
     */
    abstract protected function getResponderClassName(): string;
}
