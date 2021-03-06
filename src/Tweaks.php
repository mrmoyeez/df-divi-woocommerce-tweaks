<?php

namespace DF\WC\Tweaks;

/**
 * Tweaks class.
 */
class Tweaks {

	protected $container;

	public function __construct($container) {
		$this->container = $container;
	}

	public function get_styles() {
		$mods = get_theme_mod('df_divi_wc_tweaks', array());
		$mods = wp_parse_args( $mods, array(
			'button_line_height' => '1.5',
		) );
		$styles = $this->add_to_cart_btn_style($mods);
		return $styles;
	}

	public function add_to_cart_btn_style($mods) {
		$styles = [];
		if (isset($mods['enable_add_to_cart_btn']) && $mods['enable_add_to_cart_btn']) {
			
			// button selector.
			$btn_selector = 'html body.woocommerce-page div.woocommerce form.woocommerce-cart-form div.coupon button.button, html body.woocommerce-page div.woocommerce form.woocommerce-cart-form button[type="submit"], .woocommerce-page div.cart-collaterals div.wc-proceed-to-checkout a.button, .woocommerce-page form.woocommerce-checkout div.place-order button.button,';

			$btn_selector .= 'html .woocommerce .woocommerce-error a.button, .woocommerce .woocommerce-info a.button, html .woocommerce .woocommerce-message a.button, html .woocommerce .woocommerce-info  a.button,';

			$btn_selector .= '.woocommerce a.button.alt, .woocommerce-page a.button.alt, .woocommerce button.button.alt, .woocommerce-page button.button.alt, .woocommerce input.button.alt, .woocommerce-page input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce-page #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce a.button, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button, .woocommerce div.product form.cart .single_add_to_cart_button, .woocommerce-page .return-to-shop a.button';

			// button selector hover
			$btn_selector_hover = 'html body.woocommerce-page div.woocommerce form.woocommerce-cart-form div.coupon button.button:hover, html body.woocommerce-page div.woocommerce form.woocommerce-cart-form button[type="submit"]:hover, .woocommerce-page div.cart-collaterals div.wc-proceed-to-checkout a.button:hover, .woocommerce-page form.woocommerce-checkout div.place-order button.button:hover,';
			$btn_selector_hover .= 'html .woocommerce .woocommerce-error a.button:hover, .woocommerce .woocommerce-info a.button:hover, html .woocommerce .woocommerce-message a.button:hover, html .woocommerce .woocommerce-info  a.button:hover,';

			$btn_selector_hover .= 'body .et_pb_button:hover, .woocommerce a.button.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce #content input.button.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce a.button:hover, .woocommerce-page a.button:hover, .woocommerce button.button:hover, .woocommerce-page button.button:hover, .woocommerce input.button:hover, .woocommerce-page input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce-page #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page #content input.button:hover,.woocommerce div.product form.cart .single_add_to_cart_button:hover, .woocommerce-page .return-to-shop a.button:hover';

			if (isset($mods['btn_background_color'])) {
				$styles[$btn_selector][] = sprintf('background-color: %s !important;', $mods['btn_background_color']);
			}

			if (isset($mods['btn_border_radius'])) {
				$styles[$btn_selector][] = sprintf('border-radius: %spx !important;', $mods['btn_border_radius']);
			}

			if (isset($mods['btn_border_radius_hover'])) {
				$styles[$btn_selector_hover][] = sprintf('border-radius: %spx !important;', $mods['btn_border_radius_hover']);
			}

			// wp_die(var_dump($mods));
			if (isset($mods['btn_background_color_hover'])) {
				$styles[$btn_selector_hover][] = sprintf('background-color: %s !important;', $mods['btn_background_color_hover']);
			}

			if (isset($mods['btn_font_color_hover'])) {
				$styles[$btn_selector_hover][] = sprintf('color: %s !important;', $mods['btn_font_color_hover']);
			}


			if (isset($mods['btn_font'])) {
				$styles[$btn_selector][] = $this->container['kirki']->raw_css('kirki-typography', $mods['btn_font']);

				// button after icon (arrow) needs to have the same font size.
				$styles['html body.woocommerce-page .button:after'][] = sprintf('font-size: inherit !important');
			}

			$styles['.woocommerce-page .return-to-shop a.button:after'][] = 'position:relative !important';


			//line height button
			$styles[' input.button:after, .woocommerce-page #content input.button.alt:after, .woocommerce-page #content input.button:after, .woocommerce-page #respond input#submit.alt:after, .woocommerce-page #respond input#submit:after, .woocommerce-page a.button.alt:after, .woocommerce-page a.button:after, .woocommerce-page button.button.alt:after, .woocommerce-page button.button:after, .woocommerce-page input.button.alt:after, .woocommerce-page input.button:after'][] = 'line-height:' . $mods['button_line_height'];

		} //end button styles.

		$alert_message_selector = 'html .woocommerce .woocommerce-error, .woocommerce .woocommerce-info, html .woocommerce .woocommerce-message, html .woocommerce .woocommerce-info a, html .woocommerce-page .woocommerce-message';

		if (isset($mods['alert_bg_color'])) {
			$styles[$alert_message_selector][] = sprintf('background-color: %s !important;', $mods['alert_bg_color']);
		}


		if (isset($mods['alert_font'])) {
			$styles[$alert_message_selector][] = $this->container['kirki']->raw_css('kirki-typography', $mods['alert_font']);
		}

		$sale_badge_selector = '.woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce-page span.onsale';

		if (isset($mods['sale_badge_bg_color'])) {
			$styles[$sale_badge_selector][] = sprintf('background-color: %s !important;', $mods['sale_badge_bg_color']);
		}

		if (isset($mods['sale_badge_font'])) {
			$styles[$sale_badge_selector][] = $this->container['kirki']->raw_css('kirki-typography', $mods['sale_badge_font']);
		}




		

		$css = '';

		foreach($styles as $selector => $css_values){
			$css .= sprintf('%s{%s}', $selector, implode('', $css_values) );
		}

		return $css;

	}

}