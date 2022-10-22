<?php
/**
 * Template for 404 pages
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 */

get_header();
?>
	<main>
        <div class="error-404 not-found">
            <header class="page-header ghwp-post-container">
                <h1><?php _e( 'Die von Ihnen angeforderte Seite wurde nicht gefunden (Fehler 404).', 'ghwp' ); ?></h1>
            </header>

            <div class="page-content ghwp-post-container">
                <p>Entschuldigen Sie bitte.<br>
                   Gegebenenfalls gibt es gerade ein technisches Problem.<br>
                   Oder haben Sie sich vielleicht vertippt?</p>

                <p>Versuchen Sie bitte <a href="<?php echo home_url(); ?>" title="Zurück zur Startseite der Kanzleisoftware Advolux">advolux.de</a> um Ihre Zielseite zu erreichen.</p>

                <p>Vielen Dank!</p>
            </div>
        </div>
    </main>
<?php
get_footer();
