<?php

namespace Sillynet\Domain\CustomPostType;

use DateTime;
use DateTimeInterface;
use Gebruederheitz\Wordpress\CustomPostType\PostType;
use Gebruederheitz\Wordpress\CustomPostType\PostTypeRegistrationArgs;
use Gebruederheitz\Wordpress\MetaFields\Input\DateTimeInput;
use Gebruederheitz\Wordpress\MetaFields\MetaForms;
use Sillynet\Domain\Entity\Event;
use Sillynet\Domain\Repository\EventRepository;
use WP_Post;

class EventPostType extends PostType
{
    /**
     * @required Supply a slug-type name which will be used in the DB amongst
     *           other places
     */
    public static $postTypeName = 'events';

    /**
     * @required The name users will see
     */
    public static $prettyName = 'Event';

    /**
     * @optional Where the metabox will appear: one of 'side', 'normal', 'advanced'
     * @default 'side'
     */
    //    public static $context = 'normal';

    /**
     * @var bool Whether to use a Gutenberg editor and call the allowed block
     *           types hook. Set to "false" by default, so if you don't need
     *           Gutenberg you can just leave this out.
     */
    protected $withGutenberg = true;

    /**
     * @var bool Whether to load the media picker scripts on the edit page.
     *           If you don't need to use a media picker, you can leave this
     *           bit out.
     */
    protected $withMedia = true;

    /**
     * @var array<string> List of allowed block types if Gutenberg is enabled.
     *                    If you did not set $withGutenberg to `true` you won't
     *                    need this. Otherwise supply a string-array of block
     *                    names (e.g. `core/button`).
     */
    protected $allowedBlockTypes = [
        'core/paragraph',
        'core/columns',
        'core/gallery',
        'core/image',
        'core/buttons',
    ];

    /**
     * @var string The translation domain to use for menu labels etc.
     *
     * If you are using the "ghwp" domain, you can skip this setting, otherwise
     * set it to your theme / plugin's i18n domain.
     */
    protected $translationDomain = 'sillynet';

    /**
     * @inheritDoc
     */
    public function renderMetabox(): void
    {
        /** @var WP_Post */
        global $post;

        /** @var Event $event */
        $event = EventRepository::getInstance()->find($post->ID);

        MetaForms::makeTextInputField(Event::facebookEventUrlField)
            ->setValue($event->getFacebookEventUrl() ?? '')
            ->setLabel('Facebook Event URL')
            ->render();

        MetaForms::makeDateTimeInputField(Event::datetimeField)
            ->setValue($event->getDatetime()?->format('Y-m-d\TH:i') ?: '')
            ->setLabel('Date & Time')
            ->render();

        MetaForms::makeTextInputField(Event::locationField)
            ->setValue($event->getLocation())
            ->setLabel('Location / Town / City')
            ->setRequired(true)
            ->render();

        MetaForms::makeTextInputField(Event::locationUrlField)
            ->setValue($event->getLocationUrl() ?: '')
            ->setLabel('Location URL (Map Link etc.)')
            ->render();

        MetaForms::makeTextInputField(Event::venueField)
            ->setValue($event->getVenue() ?: '')
            ->setLabel('Venue')
            ->render();

        MetaForms::makeTextInputField(Event::venueUrlField)
            ->setValue($event->getVenueUrl() ?: '')
            ->setLabel('Venue URL')
            ->render();

        MetaForms::makeTextArea(Event::relatedArtistsField)
            ->setValue(implode(';', $event->getRelatedArtists()))
            ->setLabel('Related Artists')
            ->render();

        MetaForms::makeTextInputField(Event::ticketUrlField)
            ->setValue($event->getTicketUrl() ?: '')
            ->setLabel('Ticket URL')
            ->render();
    }

    /**
     * @inheritDoc
     */
    public function savePostMeta(WP_Post $post, array $data): void
    {
        $repo = EventRepository::getInstance();
        /** @var Event $event */
        $event = $repo->find($post->ID);

        if (
            isset($data[Event::facebookEventUrlField]) &&
            is_string($data[Event::facebookEventUrlField])
        ) {
            $event->setFacebookEventUrl($data[Event::facebookEventUrlField]);
        }

        if (
            isset($data[Event::datetimeField]) &&
            is_string($data[Event::datetimeField])
        ) {
            $parsedDatetime = DateTime::createFromFormat(
                'Y-m-d\TH:i',
                $data[Event::datetimeField],
            );
            if ($parsedDatetime) {
                $event->setDatetime($parsedDatetime);
            }
        }

        if (
            isset($data[Event::locationField]) &&
            is_string($data[Event::locationField])
        ) {
            $event->setLocation($data[Event::locationField]);
        }

        if (
            isset($data[Event::locationUrlField]) &&
            is_string($data[Event::locationUrlField])
        ) {
            $event->setLocationUrl($data[Event::locationUrlField]);
        }

        if (
            isset($data[Event::venueField]) &&
            is_string($data[Event::venueField])
        ) {
            $event->setVenue($data[Event::venueField]);
        }

        if (
            isset($data[Event::venueUrlField]) &&
            is_string($data[Event::venueUrlField])
        ) {
            $event->setVenueUrl($data[Event::venueUrlField]);
        }

        if (
            isset($data[Event::relatedArtistsField]) &&
            is_string($data[Event::relatedArtistsField])
        ) {
            $rawRelatedArtists = explode(
                ';',
                $data[Event::relatedArtistsField],
            );
            $relatedArtists = array_filter(
                array_map('trim', $rawRelatedArtists),
            );
            if (!empty($relatedArtists)) {
                $event->setRelatedArtists($relatedArtists);
            }
        }

        if (
            isset($data[Event::ticketUrlField]) &&
            is_string($data[Event::ticketUrlField])
        ) {
            $event->setTicketUrl($data[Event::ticketUrlField]);
        }

        $repo->save($event)->flush();
    }

    /**
     * Modify the arguments for the post type's registration call.
     */
    protected function editRegistrationArgs(
        PostTypeRegistrationArgs $args,
    ): PostTypeRegistrationArgs {
        $args
            ->setPluralLabel('Events')
            ->setExcludeFromSearch(true)
            ->setHasArchive(true)
            ->setMenuIcon('dashicons-format-audio')
            ->addThumbnailSupport()
            ->makePublic();

        return $args;
    }
}
