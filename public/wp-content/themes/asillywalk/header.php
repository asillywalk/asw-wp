<?php
/**
 * Template for the header
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

use Sillynet\Domain\PageOrPostOption\IntroAnimation;
use Sillynet\Domain\PageOrPostOption\PageHero;

if (!isset($post->ID)) {
    return;
}

$hero = PageHero::getValue($post->ID);
$animation = IntroAnimation::getValue($post->ID);
error_log('animation? ' . json_encode($animation));
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php i("meta.favicons"); ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class('parade-bg'); ?>>
    <div id="top"></div>
    <a class="skip-link sr-only" href="#content">
        <?php _e("Skip to content", "sillynet"); ?>
    </a>

    <?php i("header", ['is_hero_page' => $hero]); ?>

    <div id="content" class="content<?php
    if ($hero) {
        echo " content--with-hero";
    }
    if ($animation) {
        echo " content--with-animation";
    }
    ?>">
