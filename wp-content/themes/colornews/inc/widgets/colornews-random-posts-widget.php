<?php
/**
 * Random Post widget
 */

class colornews_random_posts_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'colornews_random_post colornews_custom_widget',
			'description' => __( 'Displays the random posts from your site. Suitable for the Right/Left sidebar.', 'colornews' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Random Posts Widget', 'colornews' ), $widget_ops );
	}

	function form( $instance ) {
		$tg_defaults['number'] = 6;
		$tg_defaults['title']  = '';
		$instance              = wp_parse_args( (array) $instance, $tg_defaults );
		$number                = $instance['number'];
		$title                 = esc_attr( $instance['title'] );
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'colornews' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of random posts to display:', 'colornews' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance           = $old_instance;
		$instance['number'] = absint( $new_instance['number'] );
		$instance['title']  = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$number = empty( $instance['number'] ) ? 6 : $instance['number'];
		$title  = isset( $instance['title'] ) ? $instance['title'] : '';

		echo $before_widget;

		?>

		<div class="magazine-block-3 clearfix">
			<div class="tg-block-wrapper clearfix">
				<?php
				global $post;

				$get_featured_posts = new WP_Query( array(
					'posts_per_page'      => $number,
					'post_type'           => 'post',
					'ignore_sticky_posts' => true,
					'orderby'             => 'rand',
				) );
				?>
				<?php $featured = 'colornews-random-posts'; ?>
				<?php
				if ( ! empty( $title ) ) {
					echo $before_title . esc_html( $title ) . $after_title;
				} ?>
				<div class="random-post-wrapper">
					<div class="tg-column-wrapper clearfix">
						<?php
						$i = 1;
						$j = 1;
						while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
							if ( ( $j == $number ) || ( $j == $number - 1 ) || ( $j == $number - 2 ) ) {
								$class = "";
							} else {
								$class = "tg-column-bottom-margin";
							}
							?>
							<div class="tg-column-3 random-post-block <?php echo $class; ?>">
								<?php
								if ( has_post_thumbnail() ) {
									$image           = '';
									$title_attribute = get_the_title( $post->ID );
									$image_id        = get_post_thumbnail_id( get_the_ID() );
									$image_alt       = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
									$image_alt_text  = ! empty( $image_alt ) ? $image_alt : $title_attribute;
									$image           .= get_the_post_thumbnail( $post->ID, $featured, array(
										'title' => esc_attr( $title_attribute ),
										'alt'   => esc_attr( $image_alt_text ),
									) );
									$image           .= colornews_colored_category_return( 0 );
									echo $image;
								} else { ?>
									<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/random-placeholder.png">
									<?php echo colornews_colored_category_return( 0 ); ?>
								<?php }
								?>
								<div class="random-post-hover">
									<h3 class="entry-title"><?php echo get_the_title(); ?></h3>
									<?php
									// image to display in popup
									$image_popup_id  = get_post_thumbnail_id();
									$image_popup_url = wp_get_attachment_url( $image_popup_id );
									?>
									<div class="random-hover-link">
										<a href="<?php echo $image_popup_url; ?>" class="image-popup"><i class="fa fa-search-plus"></i></a>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><i class="fa fa-link"></i></a>
									</div>
								</div>
							</div>
							<?php
							$j ++;
							$i ++;
						endwhile;
						// Reset Post Data
						wp_reset_query();
						?>
					</div>
				</div>
			</div>
		</div>
		<?php echo $after_widget;
	}
}
