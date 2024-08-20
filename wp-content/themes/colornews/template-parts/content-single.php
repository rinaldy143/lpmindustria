<?php
/**
 * Template part for displaying single posts.
 *
 * @package ThemeGrill
 * @subpackage ColorNews
 * @since ColorNews 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <?php do_action( 'colornews_before_post_content' ); ?>

   <?php
      $image_popup_id = get_post_thumbnail_id();
      $image_popup_url = wp_get_attachment_url( $image_popup_id );
   ?>

   <?php
   if ( has_post_thumbnail() ) {
      $featured_image_class = 'featured-image-enable';
   } else {
      $featured_image_class = '';
   }
   ?>
   <!-- // Tambahkan breadcrumbs di sini   -->
   <?php the_breadcrumb(); ?> 

   <div class="figure-cat-wrap <?php echo $featured_image_class; ?>">
      <?php 
      ?>
   <?php if ( get_post_format() !== 'image' && get_post_format() !== 'video' ) { ?>
      <?php if ( has_post_thumbnail() ) { ?>
            <div class="featured-image">
            <?php if ( get_theme_mod('colornews_featured_image_popup', 0) == 1 ) { ?>
                  <a href="<?php echo $image_popup_url; ?>" class="image-popup"><?php the_post_thumbnail( 'colornews-featured-image' ); ?></a>
            <?php } else { ?>
                  <?php the_post_thumbnail( 'colornews-featured-image' ); ?>
            <?php } ?>
            </div>
         <?php } ?>
         <?php colornews_colored_category_return(1); ?>
      <?php } ?>


   </div>

   <?php if( get_post_format() ) { get_template_part( '/inc/post-formats' ); } ?>

	<?php colornews_published_date(); ?>

   <header class="entry-header">
      <h1 class="entry-title">
         <?php the_title(); ?>
      </h1>
   </header>

   <?php colornews_entry_meta(); ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'colornews' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

   <p class="share-text">Bagikan :</p>
      <ul class="social-buttons mt-5">
      	<?php
      	global $wp;
      	$current_url = home_url(add_query_arg(array(), $wp->request));
      	?>
      	<li>
      		<a target="_blank" class="social-button" href="https://wa.me/?text=<?php echo $current_url ?>">
      			<img class="" src="<?php echo get_template_directory_uri(); ?>/img/icon/whatsapp-circle.svg" alt="whatsapp">
      		</a>
      	</li>
      	<li>
      		<a target="_blank" class="social-button" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_url ?>">
      			<img class="" src="<?php echo get_template_directory_uri(); ?>/img/icon/Facebook-logo-2019.svg" alt="facebook">
      		</a>
      	</li>
      	<li>
      		<a target="_blank" class="social-button" href="https://twitter.com/intent/tweet?url=<?php echo $current_url ?>">
      			<img class="" src="<?php echo get_template_directory_uri(); ?>/img/icon/Twitter.svg" alt="twitter">
      		</a>
      	</li>
      	<li>
      		<a target="_blank" class="social-button" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $current_url ?>">
      			<img class="" src="<?php echo get_template_directory_uri(); ?>/img/icon/Linkedin.svg" alt="linkedin">
      		</a>
      	</li>
      	<li>
      		<a target="_blank" href="<?php echo $current_url ?>" id="link-copy">
      			<img class="" src="<?php echo get_template_directory_uri(); ?>/img/icon/Link.svg" alt="link">
      		</a>
      		<div class="popup">
      			<span class="popuptext" id="copyPopup" style="display: none"></span>
      		</div>
      	</li>
      </ul>

   <?php do_action( 'colornews_after_post_content' ); ?>
</article><!-- #post-## -->