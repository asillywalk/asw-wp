<?php

namespace Sillynet\Domain\Repository;

use Gebruederheitz\Wordpress\Domain\CustomPostTypeRepository;
use Sillynet\Domain\CustomPostType\EventPostType;
use Sillynet\Domain\Entity\Event;

/**
 * @extends CustomPostTypeRepository<Event>
 */
class EventRepository extends CustomPostTypeRepository
{
    public static $metaKey = '_sillynet_events';

    /** @var class-string */
    protected static $entityClass = Event::class;

    /** @var class-string */
    protected static $postTypeClass = EventPostType::class;

    /** @var Event[] */
    protected $entities = [];
}
