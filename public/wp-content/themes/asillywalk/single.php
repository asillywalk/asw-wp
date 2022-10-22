<?php
/**
 * Template for all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

get_header();
?>
	<main>
    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content/content', 'single' );

        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
    endwhile;
    ?>
    </main>
<?php
get_footer();
