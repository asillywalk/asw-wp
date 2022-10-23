<?php

namespace Sillynet\Domain\Entity;

use DateTime;
use DateTimeInterface;
use Gebruederheitz\Wordpress\Domain\StorableEntity;
use WP_Post;

class Event implements \Gebruederheitz\Wordpress\Domain\StorableEntity
{
    private ?int $postId;
    private WP_Post $post;
    private string $title;
    private string $description = '';
    private ?DateTime $datetime = null;
    private string $location = '';
    private ?string $locationUrl;
    private ?string $venue;
    private ?string $venueUrl;
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
        $this->post = $post;
        $this->postId = $post->ID;
        $this->title = $post->post_title;
        $this->description = $post->post_content
            ? do_Blocks($post->post_content)
            : '';
        $this->datetime = $meta[self::datetimeField] ?? null;
        $this->facebookEventUrl = $meta[self::facebookEventUrlField] ?? null; #
        $this->location = $meta[self::locationField] ?? '';
        $this->locationUrl = $meta[self::locationUrlField] ?? null;
        $this->venue = $meta[self::venueField] ?? null;
        $this->venueUrl = $meta[self::venueUrlField] ?? null;
        $this->relatedArtists = isset($meta[self::relatedArtistsField])
            ? json_decode($meta[self::relatedArtistsField])
            : [];
        $this->ticketUrl = $meta[self::ticketUrlField] ?? null;
    }

    public function getPostId(): ?int
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

    public function getRelatedArtists(): array
    {
        return $this->relatedArtists;
    }

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
        return get_post_permalink($this->post);
    }

    /**
     * @inheritDoc
     */
    public function toMetaValues(): array
    {
        //        $storedDateTime = $this->datetime?->format(DateTimeInterface::ISO8601);
        $storedRelatedArtists = json_encode($this->relatedArtists);
        return [
            //            self::datetimeField => $storedDateTime,
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
