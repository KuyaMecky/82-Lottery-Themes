<?php

/**
 * WooCommerce - Checkout Core Class
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( '_82lottery_Shop_Others_Checkout' ) ) {

    class _82lottery_Shop_Others_Checkout {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            // Load Modules
                $this->load_modules();

        }


        /*
        Module Paths
        */

            function module_dir_path() {

                if( lottery_82_app_is_file_in_theme( __FILE__ ) ) {
                    return LOTTERY_82_MODULE_DIR . '/woocommerce/others/checkout/';
                } else {
                    return trailingslashit( plugin_dir_path( __FILE__ ) );
                }

            }

            function module_dir_url() {

                if( lottery_82_app_is_file_in_theme( __FILE__ ) ) {
                    return LOTTERY_82_MODULE_URI . '/woocommerce/others/checkout/';
                } else {
                    return trailingslashit( plugin_dir_url( __FILE__ ) );
                }

            }

        /**
         * Load Modules
         */
            function load_modules() {

                // Includes
                include_once $this->module_dir_path(). 'includes/index.php';

            }

    }

}

if( !function_exists('lottery_82_app_shop_others_checkout') ) {
	function lottery_82_app_shop_others_checkout() {
        $reflection = new ReflectionClass('_82lottery_Shop_Others_Checkout');
        return $reflection->newInstanceWithoutConstructor();
	}
}

_82lottery_Shop_Others_Checkout::instance();