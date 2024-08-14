<?php
/**
 * Featured Posts widget
 */

class colornews_featured_post_style_two_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_featured_posts_style_two colornews_custom_widget',
			'description' => __( 'Display latest posts or posts of specific category.', 'colornews' ),
		);
		$control_ops = array(
			'width'  => 200,
			'height' => 250,
		);
		parent::__construct( false, $name = __( 'TG: Featured Posts (Style 2)', 'colornews' ), $widget_ops );
	}

	function form( $instance ) {
		$tg_defaults['title']    = '';
		$tg_defaults['number']   = 4;
		$tg_defaults['type']     = 'latest';
		$tg_defaults['category'] = '';
		$instance                = wp_parse_args( (array) $instance, $tg_defaults );
		$title                   = esc_attr( $instance['title'] );
		$number                  = $instance['number'];
		$type                    = $instance['type'];
		$category                = $instance['category'];
		?>
		<p><?php _e( 'Layout will be as below:', 'colornews' ); ?></p>
		<div style="text-align: center;"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/style-2.jpg' ); ?>">
		</div>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'colornews' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to display:', 'colornews' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
			<input type="radio" <?php checked( $type, 'latest' ); ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest" /><?php _e( 'Show latest Posts', 'colornews' ); ?>
			<br />
			<input type="radio" <?php checked( $type, 'category' ); ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category" /><?php _e( 'Show posts from a category', 'colornews' ); ?>
			<br /></p>
		<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colornews' ); ?>
				:</label>
			<?php
			wp_dropdown_categories(
				array(
					'show_option_none' => ' ',
					'name'             => $this->get_field_name( 'category' ),
					'selected'         => $category,
				)
			);
			?>
			</p>
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
		$number   = empty( $instance['number'] ) ? 4 : $instance['number'];
		$type     = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category = isset( $instance['category'] ) ? $instance['category'] : '';

		if ( $type == 'latest' ) {
			$get_featured_posts = new WP_Query(
				array(
					'posts_per_page'      => $number,
					'post_type'           => 'post',
					'ignore_sticky_posts' => true,
				)
			);
		} else {
			$get_featured_posts = new WP_Query(
				array(
					'posts_per_page' => $number,
					'post_type'      => 'post',
					'category__in'   => $category,
				)
			);
		}
		echo $before_widget;
		?>
		<div class="magazine-block-1">
			<div class="tg-block-wrapper clearfix">
				<?php
				if ( $type != 'latest' ) {
					$background_color = 'style="background-color:' . colornews_category_color( $category ) . ';"';
				} else {
					$background_color = '';
				}
				if ( ! empty( $title ) ) {
					echo '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title" ' . $background_color . '><span>' . esc_html( $title ) . '</span></span></h3>';
				}
				?>
				<div class="featured-post-wrapper clearfix">
					<div class="tg-column-wrapper">
						<?php
						$i = 1;
						while ( $get_featured_posts->have_posts() ) :
							$get_featured_posts->the_post();
							?>
							<?php
							if ( $i == 1 ) {
								$featured = 'colornews-featured-post-medium';
							} else {
								$featured = 'colornews-featured-post-small';
							}
							?>
							<?php
							if ( $i == 1 ) {
								echo '<div class="tg-column-2"><div class="first-post">';
							} elseif ( $i == 2 ) {
								echo '<div class="tg-column-2"><div class="following-post">';
							}
							?>
							<div class="single-article clearfix">
								<?php
								if ( has_post_thumbnail() ) {
									$image           = '';
									$title_attribute = get_the_title( $post->ID );
									$image_id        = get_post_thumbnail_id( get_the_ID() );
									$image_alt       = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
									$image_alt_text  = ! empty( $image_alt ) ? $image_alt : $title_attribute;
									$image          .= '<figure>';
									$image          .= '<a href="' . get_permalink() . '" title="' . the_title( '', '', false ) . '">';
									$image          .= get_the_post_thumbnail(
										$post->ID,
										$featured,
										array(
											'title' => esc_attr( $title_attribute ),
											'alt'   => esc_attr( $image_alt_text ),
										)
									) . '</a>';
									if ( $i == 1 ) {
										$image .= colornews_colored_category_return( 0 );
									}
									$image .= '</figure>';
									echo $image;
								}
								?>
								<div class="article-content">
									<h3 class="entry-title">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</h3>
									<?php $no_featured_image_extra_class = has_post_thumbnail() ? '' : 'featured-no-image'; ?>
									<div class="below-entry-meta <?php echo $no_featured_image_extra_class; ?>">
										<?php
										$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
										$time_string = sprintf(
											$time_string,
											esc_attr( get_the_date( 'c' ) ),
											esc_html( get_the_date() )
										);
										printf(
											__( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colornews' ),
											esc_url( get_permalink() ),
											esc_attr( get_the_time() ),
											$time_string
										);
										?>
										<span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
										<span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' ); ?></span>
									</div>
									<?php if ( $i == 1 ) { ?>
										<div class="entry-content">
											<?php the_excerpt(); ?>
										</div>
										<div class="entry-btn">
											<a href="<?php the_permalink(); ?>"><?php _e( 'Read More <i class="fa fa-angle-double-right"></i>', 'colornews' ); ?></a>
										</div>
									<?php } ?>
								</div>
							</div>
							<?php
							if ( $i == 1 ) {
								echo '</div></div><!-- first post end -->';
							}
							?>
							<?php
							++$i;
						endwhile;
						if ( $i > 2 ) {
							echo '</div></div><!-- following post end -->';
						}
						// Reset Post Data
						wp_reset_query();
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
		echo $after_widget;
	}
}
