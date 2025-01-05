<?php

/**
 * WooCommerce - Single - Module - Upsell & Related - Customizer Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( '_82lottery_Shop_Customizer_Single_Upsell_Related' ) ) {

    class _82lottery_Shop_Customizer_Single_Upsell_Related {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            add_action( 'customize_register', array( $this, 'register' ), 15);

        }

        function register( $wp_customize ) {

            /**************
             *  Upsell
             **************/

                /**
                * Option : Show Upsell Products
                */
                    $wp_customize->add_setting(
                        LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-upsell-display]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new _82lottery_Customize_Control_Switch(
                            $wp_customize, LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-upsell-display]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show Upsell Products', 'lottery_82_app'),
                                'section' => 'woocommerce-single-page-upsell-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'lottery_82_app' ),
                                    'off' => esc_attr__( 'No', 'lottery_82_app' )
                                )
                            )
                        )
                    );

                /**
                 * Option : Upsell Title
                 */
                    $wp_customize->add_setting(
                        LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-upsell-title]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-upsell-title]', array(
                            'type'       => 'text',
                            'section'    => 'woocommerce-single-page-upsell-section',
                            'label'      => esc_html__( 'Upsell Title', 'lottery_82_app' )
                        )
                    );

                /**
                 * Option : Upsell Column
                 */
                    $wp_customize->add_setting(
                        LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-upsell-column]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control( new _82lottery_Customize_Control_Radio_Image(
                        $wp_customize, LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-upsell-column]', array(
                            'type' => 'wdt-radio-image',
                            'label' => esc_html__( 'Upsell Column', 'lottery_82_app'),
                            'section' => 'woocommerce-single-page-upsell-section',
                            'choices' => apply_filters( 'lottery_82_app_woo_upsell_columns_options', array(
                                1 => array(
                                    'label' => esc_html__( 'One Column', 'lottery_82_app' ),
                                    'path' => lottery_82_app_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-column.png'
                                ),
                                2 => array(
                                    'label' => esc_html__( 'One Half Column', 'lottery_82_app' ),
                                    'path' => lottery_82_app_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-half-column.png'
                                ),
                                3 => array(
                                    'label' => esc_html__( 'One Third Column', 'lottery_82_app' ),
                                    'path' => lottery_82_app_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-third-column.png'
                                ),
                                4 => array(
                                    'label' => esc_html__( 'One Fourth Column', 'lottery_82_app' ),
                                    'path' => lottery_82_app_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-fourth-column.png'
                                )
                            ))
                        )
                    ));


                /**
                * Option : Upsell Limit
                */
                    $wp_customize->add_setting(
                        LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-upsell-limit]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new _82lottery_Customize_Control(
                            $wp_customize, LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-upsell-limit]', array(
                                'type'     => 'select',
                                'label'    => esc_html__( 'Upsell Limit', 'lottery_82_app'),
                                'section'  => 'woocommerce-single-page-upsell-section',
                                'choices'  => array (
                                    1 => esc_html__( '1', 'lottery_82_app' ),
                                    2 => esc_html__( '2', 'lottery_82_app' ),
                                    3 => esc_html__( '3', 'lottery_82_app' ),
                                    4 => esc_html__( '4', 'lottery_82_app' ),
                                    5 => esc_html__( '5', 'lottery_82_app' ),
                                    6 => esc_html__( '6', 'lottery_82_app' ),
                                    7 => esc_html__( '7', 'lottery_82_app' ),
                                    8 => esc_html__( '8', 'lottery_82_app' ),
                                    9 => esc_html__( '9', 'lottery_82_app' ),
                                    10 => esc_html__( '10', 'lottery_82_app' ),
                                )
                            )
                        )
                    );

                /**
                 * Option : Product Style Template
                 */
                    $wp_customize->add_setting(
                        LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-upsell-style-template]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new _82lottery_Customize_Control(
                            $wp_customize, LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-upsell-style-template]', array(
                                'type'     => 'select',
                                'label'    => esc_html__( 'Product Style Template', 'lottery_82_app'),
                                'section'  => 'woocommerce-single-page-upsell-section',
                                'choices'  => lottery_82_app_woo_listing_customizer_settings()->product_templates_list()
                            )
                        )
                    );


            /**************
             *  Related
             **************/

                /**
                * Option : Show Related Products
                */
                    $wp_customize->add_setting(
                        LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-related-display]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new _82lottery_Customize_Control_Switch(
                            $wp_customize, LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-related-display]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show Related Products', 'lottery_82_app'),
                                'section' => 'woocommerce-single-page-related-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'lottery_82_app' ),
                                    'off' => esc_attr__( 'No', 'lottery_82_app' )
                                )
                            )
                        )
                    );

                /**
                 * Option : Related Title
                 */
                    $wp_customize->add_setting(
                        LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-related-title]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-related-title]', array(
                            'type'       => 'text',
                            'section'    => 'woocommerce-single-page-related-section',
                            'label'      => esc_html__( 'Related Title', 'lottery_82_app' )
                        )
                    );

                /**
                 * Option : Related Column
                 */
                    $wp_customize->add_setting(
                        LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-related-column]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control( new _82lottery_Customize_Control_Radio_Image(
                        $wp_customize, LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-related-column]', array(
                            'type' => 'wdt-radio-image',
                            'label' => esc_html__( 'Related Column', 'lottery_82_app'),
                            'section' => 'woocommerce-single-page-related-section',
                            'choices' => apply_filters( 'lottery_82_app_woo_related_columns_options', array(
                                1 => array(
                                    'label' => esc_html__( 'One Column', 'lottery_82_app' ),
                                    'path' => lottery_82_app_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-column.png'
                                ),
                                2 => array(
                                    'label' => esc_html__( 'One Half Column', 'lottery_82_app' ),
                                    'path' => lottery_82_app_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-half-column.png'
                                ),
                                3 => array(
                                    'label' => esc_html__( 'One Third Column', 'lottery_82_app' ),
                                    'path' => lottery_82_app_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-third-column.png'
                                ),
                                4 => array(
                                    'label' => esc_html__( 'One Fourth Column', 'lottery_82_app' ),
                                    'path' => lottery_82_app_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-fourth-column.png'
                                )
                            ))
                        )
                    ));


                /**
                * Option : Related Limit
                */
                    $wp_customize->add_setting(
                        LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-related-limit]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new _82lottery_Customize_Control(
                            $wp_customize, LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-related-limit]', array(
                                'type'     => 'select',
                                'label'    => esc_html__( 'Related Limit', 'lottery_82_app'),
                                'section'  => 'woocommerce-single-page-related-section',
                                'choices'  => array (
                                    1 => esc_html__( '1', 'lottery_82_app' ),
                                    2 => esc_html__( '2', 'lottery_82_app' ),
                                    3 => esc_html__( '3', 'lottery_82_app' ),
                                    4 => esc_html__( '4', 'lottery_82_app' ),
                                    5 => esc_html__( '5', 'lottery_82_app' ),
                                    6 => esc_html__( '6', 'lottery_82_app' ),
                                    7 => esc_html__( '7', 'lottery_82_app' ),
                                    8 => esc_html__( '8', 'lottery_82_app' ),
                                    9 => esc_html__( '9', 'lottery_82_app' ),
                                    10 => esc_html__( '10', 'lottery_82_app' ),
                                )
                            )
                        )
                    );

                /**
                 * Option : Product Style Template
                 */
                    $wp_customize->add_setting(
                        LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-related-style-template]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new _82lottery_Customize_Control(
                            $wp_customize, LOTTERY_82_CUSTOMISER_VAL . '[wdt-single-product-related-style-template]', array(
                                'type'     => 'select',
                                'label'    => esc_html__( 'Product Style Template', 'lottery_82_app'),
                                'section'  => 'woocommerce-single-page-related-section',
                                'choices'  => lottery_82_app_woo_listing_customizer_settings()->product_templates_list()
                            )
                        )
                    );


        }

    }

}


if( !function_exists('lottery_82_app_shop_customizer_single_upsell_related') ) {
	function lottery_82_app_shop_customizer_single_upsell_related() {
		return _82lottery_Shop_Customizer_Single_Upsell_Related::instance();
	}
}

lottery_82_app_shop_customizer_single_upsell_related();