<?php

/**
 * Product single template option
 **/

if( ! function_exists( 'lottery_82_app_shop_woo_product_single_template_option' ) ) {

	function lottery_82_app_shop_woo_product_single_template_option() {

		if(is_singular('product')) {

			if( function_exists( 'lottery_82_app_shop_woo_product_single_custom_template_option' ) ) {
				return lottery_82_app_shop_woo_product_single_custom_template_option();
			} else {
				return 'woo-default';
			}

		}

		return false;

	}

}