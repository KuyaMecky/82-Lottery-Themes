<?php

/**
 * WooCommerce - Others - Quantity Plus Minus - Customizer Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( '_82lottery_Shop_Customizer_Others_Quantity_Plus_Minus' ) ) {

    class _82lottery_Shop_Customizer_Others_Quantity_Plus_Minus {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            add_filter( 'lottery_82_app_woo_others_settings', array( $this, 'others_settings' ), 10, 1 );
            add_action( 'customize_register', array( $this, 'register' ), 15);

        }

        function others_settings( $settings ) {

            $enable_quantity_plusminus             = lottery_82_app_customizer_settings('wdt-woo-others-enable-quantity-plusminus' );
            $settings['enable_quantity_plusminus'] = $enable_quantity_plusminus;

            return $settings;

        }

        function register( $wp_customize ) {

            /**
             * Option : Enable Quantity Plus Minus
             */

                $wp_customize->add_setting(
                    LOTTERY_82_CUSTOMISER_VAL . '[wdt-woo-others-enable-quantity-plusminus]', array(
                        'type' => 'option',
                        'sanitize_callback' => 'wp_filter_nohtml_kses'
                    )
                );

                $wp_customize->add_control(
                    new _82lottery_Customize_Control_Switch(
                        $wp_customize, LOTTERY_82_CUSTOMISER_VAL . '[wdt-woo-others-enable-quantity-plusminus]', array(
                            'type'    => 'wdt-switch',
                            'label'   => esc_html__( 'Enable Quantity Plus Minus', 'lottery_82_app'),
                            'section' => 'woocommerce-others-section',
                            'choices' => array(
                                'on'  => esc_attr__( 'Yes', 'lottery_82_app' ),
                                'off' => esc_attr__( 'No', 'lottery_82_app' )
                            )
                        )
                    )
                );

        }

    }

}


if( !function_exists('lottery_82_app_shop_customizer_others_quantity_plus_minus') ) {
	function lottery_82_app_shop_customizer_others_quantity_plus_minus() {
		return _82lottery_Shop_Customizer_Others_Quantity_Plus_Minus::instance();
	}
}

lottery_82_app_shop_customizer_others_quantity_plus_minus();