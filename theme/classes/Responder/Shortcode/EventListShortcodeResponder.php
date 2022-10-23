<?php

namespace Sillynet\Responder\Shortcode;

use Sillynet\Action\Shortcode\ShortcodeAction;
use Sillynet\Adretto\Action\Action;
use Sillynet\Adretto\WpTwig\Responder\TwigResponder;
use Sillynet\Domain\Repository\EventRepository;

class EventListShortcodeResponder extends ShortcodeResponder
{
    protected static string $templateName = 'blocks/upcoming-events';

    /**
     * @inheritDoc
     */
    protected function getData(ShortcodeAction $action): array
    {
        $data = $action->getData();
        $limit = $data['limit'];
        $posts = EventRepository::getInstance()->findUpcoming($limit);
        $next = array_shift($posts);

        return [
            'next' => $next,
            'posts' => $posts,
        ];
    }
}
