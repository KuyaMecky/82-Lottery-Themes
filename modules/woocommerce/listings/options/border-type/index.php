<?php
/**
 * Listing Options - Image Effect
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( '_82lottery_Woo_Listing_Option_Border_Type' ) ) {

    class _82lottery_Woo_Listing_Option_Border_Type extends _82lottery_Woo_Listing_Option_Core {

        private static $_instance = null;

        public $option_slug;

        public $option_name;

        public $option_type;

        public $option_default_value;

        public $option_value_prefix;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {

            $this->option_slug          = 'product-border-type';
            $this->option_name          = esc_html__('Border Type', 'lottery_82_app');
            $this->option_type          = array ( 'class', 'value-css' );
            $this->option_default_value = 'product-border-type-default';
            $this->option_value_prefix  = 'product-border-type-';

            $this->render_backend();
        }

        /**
         * Backend Render
         */
        function render_backend() {
            add_filter( 'lottery_82_app_woo_custom_product_template_common_options', array( $this, 'woo_custom_product_template_common_options'), 40, 1 );
        }

        /**
         * Custom Product Templates - Options
         */
        function woo_custom_product_template_common_options( $template_options ) {

            array_push( $template_options, $this->setting_args() );

            return $template_options;
        }

        /**
         * Settings Group
         */
        function setting_group() {
            return 'common';
        }

        /**
         * Setting Args
         */
        function setting_args() {
            $settings            =  array ();
            $settings['id']      =  $this->option_slug;
            $settings['type']    =  'select';
            $settings['title']   =  $this->option_name;
            $settings['options'] =  array (
                'product-border-type-default' => esc_html__('Default', 'lottery_82_app'),
                'product-border-type-thumb'   => esc_html__('Thumb', 'lottery_82_app'),
            );
            $settings['default'] =  $this->option_default_value;

            return $settings;
        }
    }

}

if( !function_exists('lottery_82_app_woo_listing_option_border_type') ) {
	function lottery_82_app_woo_listing_option_border_type() {
		return _82lottery_Woo_Listing_Option_Border_Type::instance();
	}
}

lottery_82_app_woo_listing_option_border_type();