<?php
/**
 * Class to include upsell link campaign for theme.
 *
 * Class COLORNEWS_Upsell_Section
 *
 * since 1.1.7
 */

class COLORNEWS_Upsell_Section extends WP_Customize_Section {
	public $type = 'colornews-upsell-section';
	public $url  = '';
	public $id   = '';

	/**
	 * Gather the parameters passed to client JavaScript via JSON.
	 *
	 * @return array The array to be exported to the client as JSON.
	 */
	public function json() {
		$json        = parent::json();
		$json['url'] = esc_url( $this->url );
		$json['id']  = $this->id;

		return $json;
	}

	/**
	 * An Underscore (JS) template for rendering this section.
	 */
	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}" class="colornews-upsell-accordion-section control-section-{{ data.type }} cannot-expand accordion-section">
			<h3 class="accordion-section-title"><a href="{{{ data.url }}}" target="_blank">{{ data.title }}</a></h3>
		</li>
		<?php
	}
}
