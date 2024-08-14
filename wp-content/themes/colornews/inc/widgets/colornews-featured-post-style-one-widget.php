<?php
/**
 * Slider News Widget
 */

class colornews_featured_post_style_one_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_featured_posts_style_one colornews_custom_widget',
			'description' => __( 'Display latest posts or posts of specific category. Suitable for the Front Page: Slider Area.', 'colornews' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Featured Post (Style 1)', 'colornews' ), $widget_ops );
	}

	function form( $instance ) {
		$tg_defaults['number']   = 5;
		$tg_defaults['type']     = 'latest';
		$tg_defaults['category'] = '';
		$instance                = wp_parse_args( (array) $instance, $tg_defaults );
		$number                  = $instance['number'];
		$type                    = $instance['type'];
		$category                = $instance['category'];
		?>
		<p><?php _e( 'Layout will be as below:', 'colornews' ) ?></p>
		<div style="text-align: center;"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/style-1.jpg' ) ?>">
		</div>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to display:', 'colornews' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
			<input type="radio" <?php checked( $type, 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest" /><?php _e( 'Show latest Posts', 'colornews' ); ?>
			<br />
			<input type="radio" <?php checked( $type, 'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category" /><?php _e( 'Show posts from a category', 'colornews' ); ?>
			<br /></p>
		<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colornews' ); ?>
				:</label>
			<?php wp_dropdown_categories( array(
				'show_option_none' => ' ',
				'name'             => $this->get_field_name( 'category' ),
				'selected'         => $category,
			) ); ?></p>
	<?php }

	function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['number']   = absint( $new_instance['number'] );
		$instance['type']     = $new_instance['type'];
		$instance['category'] = $new_instance['category'];

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$number   = empty( $instance['number'] ) ? 5 : $instance['number'];
		$type     = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category = isset( $instance['category'] ) ? $instance['category'] : '';

		if ( $type == 'latest' ) {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page'      => $number,
				'post_type'           => 'post',
				'ignore_sticky_posts' => true,
			) );
		} else {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' => $number,
				'post_type'      => 'post',
				'category__in'   => $category,
			) );
		}
		echo $before_widget;
		?>
		<div class="tg-block-wrapper clearfix">
			<div class="home-slider">
				<?php
				$i                = 1;
				$big_image        = '';
				$big_image_output = '';
				$thumbnail_image  = '';
				$post_count       = $get_featured_posts->post_count;
				while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
					$j               = $i - 1;
					$title_attribute = get_the_title( $post->ID );
					$image_id        = get_post_thumbnail_id( get_the_ID() );
					$image_alt       = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
					$image_alt_text  = ! empty( $image_alt ) ? $image_alt : $title_attribute;
					if ( has_post_thumbnail() ) {
						$big_image       = '<a href="' . get_permalink( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, 'colornews-big-slider', array(
								'title' => esc_attr( $title_attribute ),
								'alt'   => esc_attr( $image_alt_text ),
							) ) . '</a>';
						$thumbnail_image .= '<a data-slide-index="' . $j . '" href="">' . get_the_post_thumbnail( $post->ID, 'colornews-big-slider-thumb', array(
								'title' => esc_attr( $title_attribute ),
								'alt'   => esc_attr( $image_alt_text ),
							) ) . '</a>';
					} else {
						$big_image       = '<a href="' . get_permalink( $post->ID ) . '"><img src="' . get_template_directory_uri() . '/img/big-slider.png">' . '</a>';
						$thumbnail_image .= '<a data-slide-index="' . $j . '" href=""><img src="' . get_template_directory_uri() . '/img/big-slider-thumb.png">' . '</a>';
					}
					$big_image_output .= '<li>' . $big_image . '<div class="caption-wrapper"><div class="caption-desc"><h3 class="caption-title"><a href="' . get_permalink() . '" title="' . esc_attr( $title_attribute ) . '">' . get_the_title() . '</a></h3><div class="caption-content">' . get_the_excerpt() . '</div></div><div class="slider-btn"><a href="' . get_permalink() . '">' . __( ' Read More <i class="fa fa-angle-double-right"></i>', 'colornews' ) . '</a></div></div><div class="slider-category">' . colornews_colored_category_return( 0 ) . '</div></li>';
					if ( $i == $number || $i == $post_count ) {
						?>
						<ul class="bxslider">
							<?php echo $big_image_output; ?>
						</ul>
						<div class="bx-pager">
							<?php echo $thumbnail_image; ?>
						</div>
						<?php
					}
					$i ++;
				endwhile; ?>
				<?php
				// Reset Post Data
				wp_reset_query();
				?>
			</div>
		</div>
		<?php echo $after_widget;
	}
}
