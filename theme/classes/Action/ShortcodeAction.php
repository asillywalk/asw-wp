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

    /** @var class-string<ShortcodeResponder> $responderClassName  */
    protected static string $responderClassName = '';

    private ContainerInterface $container;

    private array|string $shortcodeArguments = [];

    public function __construct(ContainerInterface $c)
    {
        $this->container = $c;
        add_shortcode(static::$shortCodeTag, [$this, 'handle']);
        self::addDocumentation();
    }

    public function getData(): array
    {
        return is_array($this->shortcodeArguments)
            ? $this->shortcodeArguments
            : [];
    }

    public function handle($shortcodeArguments)
    {
        $responder = $this->container->get(static::$responderClassName);
        $this->shortcodeArguments = $shortcodeArguments;
        return $responder->respond($this);
    }
}
