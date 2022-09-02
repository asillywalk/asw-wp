<?php
/**
 * Template for the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

global $wp;
$link = home_url($wp->request);
$link = urlencode($link);
?>

    </div><!-- #content -->

    <footer>
        <?php i("footer"); ?>
    </footer>

<?php wp_footer(); ?>

</body>
</html>
