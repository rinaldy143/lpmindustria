<?php
/**
 * Featured Posts
 */

class colornews_featured_post_style_four_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_featured_posts_style_four colornews_custom_widget',
			'description' => __( 'Display latest posts or posts of specific category.', 'colornews' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Featured Posts (Style 4)', 'colornews' ), $widget_ops );
	}

	function form( $instance ) {
		$tg_defaults['title']    = '';
		$tg_defaults['number']   = 5;
		$tg_defaults['type']     = 'latest';
		$tg_defaults['category'] = '';
		$instance                = wp_parse_args( (array) $instance, $tg_defaults );
		$title                   = esc_attr( $instance['title'] );
		$number                  = $instance['number'];
		$type                    = $instance['type'];
		$category                = $instance['category'];
		?>
		<p><?php _e( 'Layout will be as below:', 'colornews' ) ?></p>
		<div style="text-align: center;"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/style-4.jpg' ) ?>">
		</div>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'colornews' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
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
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['number']   = absint( $new_instance['number'] );
		$instance['type']     = $new_instance['type'];
		$instance['category'] = $new_instance['category'];

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
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
		<?php $featured = 'colornews-big-slider-thumb'; ?>
		<div class="tg-multiple-slider">
			<?php
			if ( empty( $title ) ) {
				$widget_class = 'widget-title-block';
			} else {
				$widget_class = '';
			}
			?>
			<div class="tg-block-wrapper <?php echo $widget_class; ?> clearfix">
				<?php
				if ( $type != 'latest' ) {
					$background_color = 'style="background-color:' . colornews_category_color( $category ) . ';"';
				} else {
					$background_color = '';
				}
				if ( ! empty( $title ) ) {
					echo '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title" ' . $background_color . '><span>' . esc_html( $title ) . '</span></span></h3>';
				} ?>
				<div class="carousel-slider-wrapper">
					<ul class="carousel-slider">
						<?php
						$i = 1;
						while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post(); ?>
							<li>
								<a href="<?php the_permalink(); ?>">
									<?php
									if ( has_post_thumbnail() ) {
										$image           = '';
										$title_attribute = get_the_title( $post->ID );
										$image_id        = get_post_thumbnail_id( get_the_ID() );
										$image_alt       = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
										$image_alt_text  = ! empty( $image_alt ) ? $image_alt : $title_attribute;
										$image           .= '<figure>';
										$image           .= get_the_post_thumbnail( $post->ID, $featured, array(
											'title' => esc_attr( $title_attribute ),
											'alt'   => esc_attr( $image_alt_text ),
										) );
										$image           .= '</figure>';
										$image           .= '<h3 class="entry-title">';
										$image           .= get_the_title();
										$image           .= '</h3>';
										echo $image;
									}
									?>
								</a>
							</li>
							<?php
							$i ++;
						endwhile;
						// Reset Post Data
						wp_reset_query();
						?>
					</ul>
				</div>
			</div>
		</div>
		<?php echo $after_widget;
	}
}
