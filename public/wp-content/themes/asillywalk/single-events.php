<?php
    use Sillynet\Domain\Repository\EventRepository;

    global $post;
    $event = EventRepository::getInstance()->find($post->ID);

    get_header();
    i("event", [ "event" => $event, ]);
    get_footer();
