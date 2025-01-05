<?php

/**
 * Listing Core
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( '_82lottery_Woo_Listing_Core' ) ) {

    class _82lottery_Woo_Listing_Core {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            /* Load All Options */
                $this->load_all_options();

            /* Load All Types */
                $this->load_all_types();

        }

        /*
        Load All Options
        */
            function load_all_options() {

                $option_locations = apply_filters( 'lottery_82_app_woo_option_locations', array ( LOTTERY_82_MODULE_DIR. '/woocommerce/listings/options/*/index.php' ) );

                if( is_array( $option_locations ) && !empty( $option_locations ) ) {
                    foreach( $option_locations as $option_location ) {
                        foreach( glob( $option_location ) as $module ) {
                            include_once $module;
                        }
                    }
                }

            }

        /*
        Load All Types
        */
            function load_all_types() {

                $type_locations = apply_filters( 'lottery_82_app_woo_type_locations', array ( LOTTERY_82_MODULE_DIR. '/woocommerce/listings/types/*/index.php' ) );

                if( is_array( $type_locations ) && !empty( $type_locations ) ) {
                    foreach( $type_locations as $type_location ) {
                        foreach( glob( $type_location ) as $module ) {
                            include_once $module;
                        }
                    }
                }

            }

    }

}


if( !function_exists('lottery_82_app_woo_listing_core') ) {
	function lottery_82_app_woo_listing_core() {
		return _82lottery_Woo_Listing_Core::instance();
	}
}

lottery_82_app_woo_listing_core();