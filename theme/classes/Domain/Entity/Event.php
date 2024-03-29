<?php

namespace Sillynet\Domain\Entity;

use DateTime;
use Gebruederheitz\Wordpress\Domain\StorableEntity;
use WP_Error;
use WP_Post;

class Event implements StorableEntity
{
    private int $postId;
    private WP_Post $post;
    private string $title;
    private string $description = '';
    private ?DateTime $datetime = null;
    private string $location = '';
    private ?string $locationUrl;
    private ?string $venue;
    private ?string $venueUrl;
    /** @var array<string>  */
    private array $relatedArtists = [];
    private ?string $ticketUrl;
    private ?string $facebookEventUrl;

    public const datetimeField = 'sillynet-event-datetime';
    public const facebookEventUrlField = 'sillynet-event-facebook-event-url';
    public const locationField = 'sillynet-event-location';
    public const locationUrlField = 'sillynet-event-location-url';
    public const venueField = 'sillynet-event-venue';
    public const venueUrlField = 'sillynet-event-venue-url';
    public const relatedArtistsField = 'sillynet-event-related-artists';
    public const ticketUrlField = 'sillynet-event-ticket-url';

    /**
     * @inheritDoc
     */
    public function __construct(WP_Post $post = null, array $meta = [])
    {
        if (!$post) {
            return;
        }

        $this->post = $post;
        $this->postId = $post->ID;
        $this->title = $post->post_title;
        $this->description = $post->post_content
            ? do_Blocks($post->post_content)
            : '';

        if (
            isset($meta[self::datetimeField]) &&
            is_object($meta[self::datetimeField]) &&
            is_a($meta[self::datetimeField], DateTime::class)
        ) {
            $this->datetime = $meta[self::datetimeField];
        }

        $fbUrl = $meta[self::facebookEventUrlField] ?? null;
        $this->facebookEventUrl = is_string($fbUrl) ? $fbUrl : null;

        $location = $meta[self::locationField] ?? '';
        $this->location = is_string($location) ? $location : '';

        $locationUrl = $meta[self::locationUrlField] ?? null;
        $this->locationUrl = is_string($locationUrl) ? $locationUrl : null;

        $venue = $meta[self::venueField] ?? null;
        $this->venue = is_string($venue) ? $venue : null;

        $venueUrl = $meta[self::venueUrlField] ?? null;
        $this->venueUrl = is_string($venueUrl) ? $venueUrl : null;

        $relatedArtists = [];
        if (
            isset($meta[self::relatedArtistsField]) &&
            is_string($meta[self::relatedArtistsField])
        ) {
            $parsed = json_decode($meta[self::relatedArtistsField]);
            if (is_array($parsed)) {
                $relatedArtists = $parsed;
            }
        }
        $this->relatedArtists = $relatedArtists;

        $ticketUrl = $meta[self::ticketUrlField] ?? null;
        $this->ticketUrl = is_string($ticketUrl) ? $ticketUrl : null;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @inheritDoc
     */
    public function setPostId(int $postId): self
    {
        $this->postId = $postId;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDatetime(): ?DateTime
    {
        return $this->datetime;
    }

    public function getFormattedDateTime(): string
    {
        return $this->datetime?->format('d.m.Y H:i') ?: '';
    }

    public function setDatetime(?DateTime $datetime): void
    {
        $this->datetime = $datetime;
    }

    public function getFacebookEventUrl(): ?string
    {
        return $this->facebookEventUrl;
    }

    public function setFacebookEventUrl(string $facebookEventUrl): self
    {
        $this->facebookEventUrl = $facebookEventUrl;

        return $this;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getLocationUrl(): ?string
    {
        return $this->locationUrl;
    }

    public function setLocationUrl(?string $locationUrl): self
    {
        $this->locationUrl = $locationUrl;

        return $this;
    }

    public function getVenue(): ?string
    {
        return $this->venue;
    }

    public function setVenue(?string $venue): self
    {
        $this->venue = $venue;

        return $this;
    }

    public function getVenueUrl(): ?string
    {
        return $this->venueUrl;
    }

    public function setVenueUrl(?string $venueUrl): self
    {
        $this->venueUrl = $venueUrl;

        return $this;
    }

    /**
     * @return array<string>
     */
    public function getRelatedArtists(): array
    {
        return $this->relatedArtists;
    }

    /**
     * @param array<string> $relatedArtists
     */
    public function setRelatedArtists(array $relatedArtists): self
    {
        $this->relatedArtists = $relatedArtists;

        return $this;
    }

    public function getTicketUrl(): ?string
    {
        return $this->ticketUrl;
    }

    public function setTicketUrl(?string $ticketUrl): self
    {
        $this->ticketUrl = $ticketUrl;

        return $this;
    }

    /**
     * @return string HTML output for rendering the post's thumbnail
     */
    public function getImageHtml(): string
    {
        return get_the_post_thumbnail($this->post, 'event_thumb');
    }

    public function getPermalink(): string
    {
        /** @var string|WP_Error $link */
        $link = get_post_permalink($this->post);
        if (is_wp_error($link)) {
            return '';
        }

        return $link;
    }

    /**
     * @inheritDoc
     *
     * @NB datetime is stored in a separate meta field by the repository, in
     * order to allow for sorting & filtering.
     */
    public function toMetaValues(): array
    {
        $storedRelatedArtists = json_encode($this->relatedArtists);
        return [
            self::facebookEventUrlField => $this->facebookEventUrl,
            self::locationField => $this->location,
            self::locationUrlField => $this->locationUrl,
            self::venueField => $this->venue,
            self::venueUrlField => $this->venueUrl,
            self::relatedArtistsField => $storedRelatedArtists,
            self::ticketUrlField => $this->ticketUrl,
        ];
    }
}
