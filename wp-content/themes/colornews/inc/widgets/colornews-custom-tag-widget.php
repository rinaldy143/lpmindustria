<?php
/**
 * Custom Tag Widget
 */

class colornews_custom_tag_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'colornews_tagcloud_widget colornews_custom_widget', 'description' => __( 'This widget will display the Custom Tags.', 'colornews' ) );
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Custom Tag Cloud', 'colornews' ) , $widget_ops, $control_ops );
	}

	function form($instance) {
		$instance = wp_parse_args( ( array ) $instance, array( 'title'=>'Tags' ) );
		$title = esc_attr( $instance[ 'title' ] );
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colornews' ); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$title = empty( $instance[ 'title' ] ) ? 'Tags' : $instance[ 'title' ];

		echo $before_widget;

		$args = array(
			'smallest'                  => 16,
			'largest'                   => 30,
			'unit'                      => 'px',
			'number'                    => 75,
		);
		?>
		<div class="tg-block-wrapper clearfix">
			<?php
			if ( $title ):
				echo $before_title . esc_html( $title ) . $after_title;
			endif;
			?>
			<div class="tag-cloud-wrap">
				<?php wp_tag_cloud( $args ); ?>
			</div>
		</div>
		<?php echo $after_widget;
	}
}
