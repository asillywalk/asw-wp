<?php
/**
 * Template for archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>
	<main>
    <?php if ( have_posts() ) : ?>
        <header class="page-header">
            <?php
                the_archive_title( '<h1>', '</h1>' );
            ?>
        </header>
        <?php
        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/content/content', 'excerpt' );
        endwhile;

        ghwp_the_posts_navigation();
    else :
        get_template_part( 'template-parts/content/content', 'none' );
    endif;
    ?>
    </main>
<?php
get_footer();
