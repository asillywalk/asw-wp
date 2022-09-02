<?php
/* Default template "Full width" */

use Sillynet\Domain\PageOrPostOption\PageHero;

$showHeroSection = PageHero::getValue($post->ID);

get_header();
i("page", [
    "show_page_hero" => $showHeroSection,
]);
get_footer();
