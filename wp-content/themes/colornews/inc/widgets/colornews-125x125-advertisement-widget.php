<?php
/**
 * 125x125 Advertisement Ads Widget
 */

class colornews_125x125_advertisement_widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_125x125_advertisement colornews_custom_widget', 'description' => __( 'Add your 125x125 Advertisement here', 'colornews') );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false,$name= __( 'TG: 125x125 Advertisement', 'colornews' ),$widget_ops);
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', '125x125_image_url_1' => '', '125x125_image_url_2' => '', '125x125_image_url_3' => '', '125x125_image_url_4' => '', '125x125_image_url_5' => '', '125x125_image_url_6' => '', '125x125_image_link_1' => '', '125x125_image_link_2' => '', '125x125_image_link_3' => '', '125x125_image_link_4' => '', '125x125_image_link_5' => '', '125x125_image_link_6' => '') );
		$title = esc_attr( $instance[ 'title' ] );
		for ( $i = 1; $i < 7; $i++ ) {
			$image_link = '125x125_image_link_'.$i;
			$image_url = '125x125_image_url_'.$i;

			$instance[ $image_link ] = esc_url( $instance[ $image_link ] );
			$instance[ $image_url ] = esc_url( $instance[ $image_url ] );
		}
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colornews' ); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<label><?php _e( 'Add your 125x125 Advertisement Images Here', 'colornews' ); ?></label>
		<?php
		for ( $i = 1; $i < 7 ; $i++ ) {
			$image_link = '125x125_image_link_'.$i;
			$image_url = '125x125_image_url_'.$i;
			?>
			<p><label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( '125x125 Advertisement Image Link ', 'colornews' ); echo $i; ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[$image_link]; ?>"/></p>
			<p>
				<label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( '125x125 Advertisement Image ', 'colornews' ); echo $i; ?></label>

			<div class="media-uploader" id="<?php echo $this->get_field_id( $image_url ); ?>">
				<div class="custom_media_preview">
					<?php if ( $instance[ $image_url ] != '' ) : ?>
						<img class="custom_media_preview_default" src="<?php echo esc_url( $instance[ $image_url ] ); ?>" style="max-width:100%;" />
					<?php endif; ?>
				</div>
				<input type="text" class="widefat custom_media_input" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo esc_url( $instance[$image_url] ); ?>" style="margin-top:5px;" />
				<button class="custom_media_upload button button-secondary button-large" id="<?php echo $this->get_field_id( $image_url ); ?>" data-choose="<?php esc_attr_e( 'Choose an image', 'colornews' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'colornews' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'colornews' ); ?></button>
			</div>
			</p>
		<?php } ?>

	<?php }
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		for ( $i = 1; $i < 7; $i++ ) {
			$image_link = '125x125_image_link_'.$i;
			$image_url = '125x125_image_url_'.$i;

			$instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
			$instance[ $image_url ] = esc_url_raw( $new_instance[ $image_url ] );
		}

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$image_array = array();
		$link_array = array();

		for ( $i = 1; $i < 7; $i++ ) {
			$image_link = '125x125_image_link_'.$i;
			$image_url = '125x125_image_url_'.$i;

			$image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
			$image_url = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';
			if( !empty( $image_link ) ) array_push( $link_array, $image_link );
			if( !empty( $image_url ) ) array_push( $image_array, $image_url );
		}
		echo $before_widget; ?>

		<div class="magazine-block-small-ad clearfix">
			<div class="tg-block-wrapper">
				<?php if ( !empty( $title ) ) {
					echo $before_title. esc_html( $title ) . $after_title;
				}
				$output = '';
				if ( !empty( $image_array ) ) {
					$output .= '<div class="ad-image ad-image-small clearfix"><div class="tg-column-wrapper">';
					for ( $i = 1; $i < 7; $i++ ) {
						$j = $i - 1;
						if( !empty( $image_array[$j] ) ) {
							if ( !empty( $link_array[$j] ) ) {
								$output .= '<a href="'.$link_array[$j].'" target="_blank"><img src="'.$image_array[$j].'" width="125" height="125" rel="nofollow"></a>';
							} else {
								$output .= '<img src="'.$image_array[$j].'" width="125" height="125" rel="nofollow">';
							}
						}
					}
					$output .= '</div></div>';
					echo $output;
				} ?>
			</div>
		</div>
		<?php
		echo $after_widget;
	}
}
