<?php
/**
 * Template for search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 */

get_header();
?>
    <main>
        <?php if ( have_posts() ) : ?>
            <header class="page-header">
                <h1><?php _e( 'Search results for:', 'ghwp' ); ?> <?php echo get_search_query(); ?></h1>
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
