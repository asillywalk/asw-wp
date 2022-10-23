<?php

namespace Sillynet\Domain\Repository;

use DateTime;
use DateTimeInterface;
use Gebruederheitz\Wordpress\Domain\CustomPostTypeRepository;
use Gebruederheitz\Wordpress\Domain\StorableEntity;
use Sillynet\Domain\CustomPostType\EventPostType;
use Sillynet\Domain\Entity\Event;
use WP_Post;

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

    /**
     * @param int $limit
     *
     * @return array<WP_Post>
     */
    public function findUpcoming(int $limit = 6): array
    {
        $query = [
            'numberposts' => $limit,
            'order' => 'ASC',
            'orderby' => 'event_date',
            'meta_query' => [
                'event_date' => [
                    'key' => self::$metaKey . '--event_date',
                    'compare' => '>',
                    'value' => date('Y-m-d H:i:s'),
                    'type' => 'DATETIME',
                ],
            ],
        ];
        $posts = self::getPosts($query);
        $mapped = self::mapPostsToEntities($posts);

        return array_column($mapped, 'item');
    }

    protected static function getMetaValues(int $postId): array
    {
        $meta = parent::getMetaValues($postId);
        $datetime =
            get_post_meta($postId, static::$metaKey . '--event_date', true) ??
            null;

        if (isset($datetime) && is_string($datetime)) {
            $parsedDatetime = DateTime::createFromFormat(
                DateTimeInterface::ISO8601,
                $datetime,
            );
            if ($parsedDatetime !== false) {
                $meta[Event::datetimeField] = $parsedDatetime;
            }
        }

        return $meta;
    }

    /**
     * @param Event $item
     */
    protected function persist(StorableEntity $item): void
    {
        parent::persist($item);
        $storedDateTime = $item
            ->getDatetime()
            ?->format(DateTimeInterface::ISO8601);
        update_post_meta(
            $item->getPostId(),
            static::$metaKey . '--event_date',
            $storedDateTime,
        );
    }
}
