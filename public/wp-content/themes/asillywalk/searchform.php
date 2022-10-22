<?php
/**
 * Template for the search form
 */
?>

<form id="ghwp-searchbar" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div id="ghwp-search" class="form-group">
        <label for="ghwp-search-term" class="sr-only">Suchbegriff(e)</label>

        <input type="search" id="ghwp-search-term" class="form-control" placeholder="Suchen …" value="<?php echo get_search_query(); ?>" name="s" />

        <button type="submit" class="sr-only">Senden</button>
    </div>
</form>
