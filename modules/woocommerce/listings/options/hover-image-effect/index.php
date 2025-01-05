<?php
/**
 * Listing Options - Image Effect
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( '_82lottery_Woo_Listing_Option_Hover_Image_Effect' ) ) {

    class _82lottery_Woo_Listing_Option_Hover_Image_Effect extends _82lottery_Woo_Listing_Option_Core {

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

            $this->option_slug          = 'product-hover-image-effect';
            $this->option_name          = esc_html__('Image Effect', 'lottery_82_app');
            $this->option_type          = array ( 'class', 'value-css' );
            $this->option_default_value = '';
            $this->option_value_prefix  = 'product-hover-image-';

            $this->render_backend();
        }

        /**
         * Backend Render
         */
        function render_backend() {
            add_filter( 'lottery_82_app_woo_custom_product_template_hover_options', array( $this, 'woo_custom_product_template_hover_options'), 10, 1 );
        }

        /**
         * Custom Product Templates - Options
         */
        function woo_custom_product_template_hover_options( $template_options ) {

            array_push( $template_options, $this->setting_args() );

            return $template_options;
        }

        /**
         * Settings Group
         */
        function setting_group() {
            return 'hover';
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
                ''                                => esc_html__('None', 'lottery_82_app'),
                'product-hover-image-blur'        => esc_html__('Blur', 'lottery_82_app'),
                'product-hover-image-blackwhite'  => esc_html__('Black & White', 'lottery_82_app'),
                'product-hover-image-fadeinleft'  => esc_html__('Fade In Left', 'lottery_82_app'),
                'product-hover-image-fadeinright' => esc_html__('Fade In Right', 'lottery_82_app'),
                'product-hover-image-rotate'      => esc_html__('Rotate', 'lottery_82_app'),
                'product-hover-image-rotatealt'   => esc_html__('Rotate - Alt', 'lottery_82_app'),
                'product-hover-image-scalein'     => esc_html__('Scale In', 'lottery_82_app'),
                'product-hover-image-scaleout'    => esc_html__('Scale Out', 'lottery_82_app'),
                'product-hover-image-floatout'    => esc_html__('Float Up', 'lottery_82_app')

            );
            $settings['default'] =  $this->option_default_value;

            return $settings;
        }
    }

}

if( !function_exists('lottery_82_app_woo_listing_option_hover_image_effect') ) {
	function lottery_82_app_woo_listing_option_hover_image_effect() {
		return _82lottery_Woo_Listing_Option_Hover_Image_Effect::instance();
	}
}

lottery_82_app_woo_listing_option_hover_image_effect();