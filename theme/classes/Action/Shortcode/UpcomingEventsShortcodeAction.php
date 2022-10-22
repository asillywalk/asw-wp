<?php

namespace Sillynet\Action\Shortcode;

use Gebruederheitz\Wordpress\Documentation\Annotations\ShortcodeDocumentation;
use Sillynet\Responder\Shortcode\EventListShortcodeResponder;

/**
 * @ShortcodeDocumentation(
 *     shortcode="upcoming-events",
 *     description="Rendert eine Liste von bevorstehenden Veranstaltungen aus den Einträgen des &quot;Events&quot; Custom-Post-Typs.",
 *     parameters={
 *       "limit": "The maximum number of events to show (default 3)"
 *     },
 *     examples={
 *       "[upcoming-events /]",
 *       "[upcoming-events limit=42 /]",
 *     }
 *  )
 */
class UpcomingEventsShortcodeAction extends ShortcodeAction
{
    protected static string $shortCodeTag = 'upcoming-events';

    /**
     * @inheritDoc
     */
    protected function getResponderClassName(): string
    {
        return EventListShortcodeResponder::class;
    }

    protected function onBeforeRespond(): void
    {
        $data = $this->getData();
        if (isset($data['limit'])) {
            $this->limit = $data['limit'];
        }
    }

    /**
     * @inheritDoc
     */
    protected function getDefaultAttributes(): array
    {
        return [
            'limit' => 6,
        ];
    }
}
