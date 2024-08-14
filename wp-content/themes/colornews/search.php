<?php
/**
 * The template for displaying search results pages.
 *
 * @package ThemeGrill
 * @subpackage ColorNews
 * @since ColorNews 1.0
 */
get_header(); ?>

   <?php do_action( 'colornews_before_body_content' ); ?>

   <div id="main" class="clearfix">
      <div class="tg-container">
         <div class="tg-inner-wrap clearfix">
            <div id="main-content-section clearfix">
               <div id="primary">

            		<?php if ( have_posts() ) : ?>

            			<header class="page-header">
            				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'colornews' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            			</header><!-- .page-header -->

            			<?php /* Start the Loop */ ?>
            			<?php while ( have_posts() ) : the_post(); ?>

            				<?php
            				/**
            				 * Run the loop for the search to output the results.
            				 * If you want to overload this in a child theme then include a file
            				 * called content-search.php and that will be used instead.
            				 */
            				get_template_part( 'template-parts/content', 'search' );
            				?>

            			<?php endwhile; ?>

            			<?php colornews_posts_navigation(); ?>

            		<?php else : ?>

            			<?php get_template_part( 'template-parts/content', 'none' ); ?>

            		<?php endif; ?>

         		</div><!-- #primary end -->
               <?php colornews_sidebar_select(); ?>
            </div><!-- #main-content-section end -->
         </div><!-- .tg-inner-wrap -->
      </div><!-- .tg-container -->
   </div><!-- #main -->

   <?php do_action( 'colornews_after_body_content' ); ?>

<?php get_footer(); ?>
