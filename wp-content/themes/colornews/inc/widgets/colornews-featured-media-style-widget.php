<?php
/**
 * Media Post widget
 */

class colornews_featured_media_style_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'colornews_featured_media_style colornews_custom_widget',
			'description' => __( 'Displays the feature Media from your site of specific category. Suitable for the Right/Left sidebar.', 'colornews' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Feature Media Widget', 'colornews' ), $widget_ops );
	}

	function form( $instance ) {
		$tg_defaults['number'] = 6;
		$tg_defaults['type']   = 'latest';
		$tg_defaults['title']  = '';
		$tg_defaults['category'] = '';
		$instance              = wp_parse_args( (array) $instance, $tg_defaults );
		$number                = $instance['number'];
		$title                 = esc_attr( $instance['title'] );
		$type                   = $instance['type'];
		$category               = $instance['category'];
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'colornews' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of random posts to display:', 'colornews' ); ?></label>
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
		$instance           = $old_instance;
		$instance['number'] = absint( $new_instance['number'] );
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['type']     = $new_instance['type'];
		$instance['category'] = $new_instance['category'];

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$number = empty( $instance['number'] ) ? 6 : $instance['number'];
		$title  = isset( $instance['title'] ) ? $instance['title'] : '';
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

		<div class="magazine-block-3 clearfix">
			<div class="tg-block-wrapper clearfix">
				<?php
				global $post;
				if ( ! empty( $title ) ) {
					echo $before_title . esc_html( $title ) . $after_title;
				} ?>
		<div class="home-slider">
    <?php
    $i                = 1;
    $big_image_output = '';
    $thumbnail_image  = '';
    $post_count       = $get_featured_posts->post_count;

    while ( $get_featured_posts->have_posts() ):
        $get_featured_posts->the_post();

        $j               = $i - 1;
        $title_attribute = get_the_title( $post->ID );
        $image_id        = get_post_thumbnail_id( get_the_ID() );
        $image_alt       = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
        $image_alt_text  = ! empty( $image_alt ) ? $image_alt : $title_attribute;

        if ( has_post_thumbnail() ) {
            $big_image = '<a href="' . get_permalink( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, 'colornews-big-slider', array(
                    'title' => esc_attr( $title_attribute ),
                    'alt'   => esc_attr( $image_alt_text ),
                ) ) . '</a>';
            $thumbnail_image .= '<a data-slide-index="' . $j . '" href="">' . get_the_post_thumbnail( $post->ID, 'colornews-big-slider-thumb', array(
                    'title' => esc_attr( $title_attribute ),
                    'alt'   => esc_attr( $image_alt_text ),
                ) ) . '</a>';
        } else {
            $big_image = '<a href="' . get_permalink( $post->ID ) . '"><img src="' . get_template_directory_uri() . '/img/big-slider.png"></a>';
            $thumbnail_image .= '<a data-slide-index="' . $j . '" href=""><img src="' . get_template_directory_uri() . '/img/big-slider-thumb.png"></a>';
        }

        $no_featured_image_extra_class = has_post_thumbnail() ? '' : 'featured-no-image';

        // Tampilkan gambar besar, meta, dan caption-wrapper
        $big_image_output .= '<li>' . $big_image . '<div class="caption-wrapper"><div class="caption-desc"><h3 class="caption-title"><a href="' . get_permalink() . '" title="' . esc_attr( $title_attribute ) . '">' . get_the_title() . '</a></h3></div></div><div class="slider-category">' . colornews_colored_category_return( 0 ) . '</div>';

        // Meta Data (tanggal, penulis, komentar)
        $time_string = '<time class="entry-date published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>';
        $big_image_output .= '<div class="below-entry-meta-sidebar' . esc_attr( $no_featured_image_extra_class ) . '">';
        $big_image_output .= sprintf(
            __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colornews' ),
            esc_url( get_permalink() ),
            esc_attr( get_the_time() ),
            $time_string
        );
        $big_image_output .= '<span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '">' . esc_html( get_the_author() ) . '</a></span></span>';
        $big_image_output .= '<span class="comments"><i class="fa fa-comment"></i>' . get_comments_number() . '</span>';
        $big_image_output .= '</div>';

        $big_image_output .= '</li>';

        if ( $i == $number || $i == $post_count ) {
            ?>
			<?php
			$unique_id = uniqid(); // Generate a unique ID
			?>
			<ul class="bxslider-sidebar bxslider-<?php echo $unique_id; ?>">
				<?php echo $big_image_output; ?>
			</ul>


            <?php
        }

        $i++;
    endwhile;
    ?>

    <?php
    // Reset Post Data
    wp_reset_postdata();
    ?>
</div>

			</div>
		</div>
		<?php echo $after_widget;
	}
}
