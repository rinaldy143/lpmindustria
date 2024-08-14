<?php
/**
 * Displays the searchform of the theme.
 *
 * @package ThemeGrill
 * @subpackage ColorNews
 * @since ColorNews 1.0
 */
?>
<form role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="searchform" method="get">
   <input type="text" placeholder="<?php _e( 'Enter a word for search', 'colornews' ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s">
   <button class="searchsubmit" name="submit" type="submit"><i class="fa fa-search"></i></button>
</form>