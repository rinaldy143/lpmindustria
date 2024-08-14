<?php
/**
 * Popular Posts widget
 */

class colornews_popular_posts_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'colornews_popular_post colornews_custom_widget',
			'description' => __( 'Displays the popular posts. Suitable for the Right/Left sidebar.', 'colornews' ),
		);
		$control_ops = array(
			'width'  => 200,
			'height' => 250,
		);
		parent::__construct( false, $name = __( 'TG: Popular Posts Widget', 'colornews' ), $widget_ops );
	}

	function form( $instance ) {
		$tg_defaults['number'] = 4;
		$tg_defaults['title']  = '';
		$instance              = wp_parse_args( (array) $instance, $tg_defaults );
		$number                = $instance['number'];
		$title                 = esc_attr( $instance['title'] );
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'colornews' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of popular posts to display:', 'colornews' ); ?></label>
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
		$number = empty( $instance['number'] ) ? 4 : $instance['number'];
		$title  = isset( $instance['title'] ) ? $instance['title'] : '';

		echo $before_widget;

		?>
		<div class="magazine-block-3">
			<div class="tg-block-wrapper clearfix">
				<?php
				global $post;

				$get_featured_posts = new WP_Query(
					array(
						'posts_per_page'      => $number,
						'post_type'           => 'post',
						'ignore_sticky_posts' => true,
						'orderby'             => 'comment_count',
					)
				);
				?>
				<?php $featured = 'colornews-featured-post-small'; ?>
				<?php
				if ( ! empty( $title ) ) {
					echo $before_title . esc_html( $title ) . $after_title;
				}
				?>
				<div class="following-post">
					<?php
					$i = 1;
					while ( $get_featured_posts->have_posts() ) :
						$get_featured_posts->the_post();
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
								$image          .= '</figure>';
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
							</div>
						</div>
						<?php
						++$i;
					endwhile;
					// Reset Post Data
					wp_reset_query();
					?>
				</div>
			</div>
		</div>
		<?php
		echo $after_widget;
	}
}

