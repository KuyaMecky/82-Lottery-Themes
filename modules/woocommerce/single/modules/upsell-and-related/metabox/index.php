<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( '_82lottery_Shop_Metabox_Single_Upsell_Related' ) ) {
    class _82lottery_Shop_Metabox_Single_Upsell_Related {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {

			add_filter( 'lottery_82_app_shop_product_custom_settings', array( $this, 'lottery_82_app_shop_product_custom_settings' ), 10 );

		}

        function lottery_82_app_shop_product_custom_settings( $options ) {

			$ct_dependency      = array ();
			$upsell_dependency  = array ( 'show-upsell', '==', 'true');
			$related_dependency = array ( 'show-related', '==', 'true');
			if( function_exists('lottery_82_app_shop_single_module_custom_template') ) {
				$ct_dependency['dependency'] 	= array ( 'product-template', '!=', 'custom-template');
				$upsell_dependency 				= array ( 'product-template|show-upsell', '!=|==', 'custom-template|true');
				$related_dependency 			= array ( 'product-template|show-related', '!=|==', 'custom-template|true');
			}

			$product_options = array (

				array_merge (
					array(
						'id'         => 'show-upsell',
						'type'       => 'select',
						'title'      => esc_html__('Show Upsell Products', 'lottery_82_app'),
						'class'      => 'chosen',
						'default'    => 'admin-option',
						'attributes' => array( 'data-depend-id' => 'show-upsell' ),
						'options'    => array(
							'admin-option' => esc_html__( 'Admin Option', 'lottery_82_app' ),
							'true'         => esc_html__( 'Show', 'lottery_82_app'),
							null           => esc_html__( 'Hide', 'lottery_82_app'),
						)
					),
					$ct_dependency
				),

				array(
					'id'         => 'upsell-column',
					'type'       => 'select',
					'title'      => esc_html__('Choose Upsell Column', 'lottery_82_app'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'lottery_82_app' ),
						1              => esc_html__( 'One Column', 'lottery_82_app' ),
						2              => esc_html__( 'Two Columns', 'lottery_82_app' ),
						3              => esc_html__( 'Three Columns', 'lottery_82_app' ),
						4              => esc_html__( 'Four Columns', 'lottery_82_app' ),
					),
					'dependency' => $upsell_dependency
				),

				array(
					'id'         => 'upsell-limit',
					'type'       => 'select',
					'title'      => esc_html__('Choose Upsell Limit', 'lottery_82_app'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'lottery_82_app' ),
						1              => esc_html__( 'One', 'lottery_82_app' ),
						2              => esc_html__( 'Two', 'lottery_82_app' ),
						3              => esc_html__( 'Three', 'lottery_82_app' ),
						4              => esc_html__( 'Four', 'lottery_82_app' ),
						5              => esc_html__( 'Five', 'lottery_82_app' ),
						6              => esc_html__( 'Six', 'lottery_82_app' ),
						7              => esc_html__( 'Seven', 'lottery_82_app' ),
						8              => esc_html__( 'Eight', 'lottery_82_app' ),
						9              => esc_html__( 'Nine', 'lottery_82_app' ),
						10              => esc_html__( 'Ten', 'lottery_82_app' ),
					),
					'dependency' => $upsell_dependency
				),

				array_merge (
					array(
						'id'         => 'show-related',
						'type'       => 'select',
						'title'      => esc_html__('Show Related Products', 'lottery_82_app'),
						'class'      => 'chosen',
						'default'    => 'admin-option',
						'attributes' => array( 'data-depend-id' => 'show-related' ),
						'options'    => array(
							'admin-option' => esc_html__( 'Admin Option', 'lottery_82_app' ),
							'true'         => esc_html__( 'Show', 'lottery_82_app'),
							null           => esc_html__( 'Hide', 'lottery_82_app'),
						)
					),
					$ct_dependency
				),

				array(
					'id'         => 'related-column',
					'type'       => 'select',
					'title'      => esc_html__('Choose Related Column', 'lottery_82_app'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'lottery_82_app' ),
						2              => esc_html__( 'Two Columns', 'lottery_82_app' ),
						3              => esc_html__( 'Three Columns', 'lottery_82_app' ),
						4              => esc_html__( 'Four Columns', 'lottery_82_app' ),
					),
					'dependency' => $related_dependency
				),

				array(
					'id'         => 'related-limit',
					'type'       => 'select',
					'title'      => esc_html__('Choose Related Limit', 'lottery_82_app'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'lottery_82_app' ),
						1              => esc_html__( 'One', 'lottery_82_app' ),
						2              => esc_html__( 'Two', 'lottery_82_app' ),
						3              => esc_html__( 'Three', 'lottery_82_app' ),
						4              => esc_html__( 'Four', 'lottery_82_app' ),
						5              => esc_html__( 'Five', 'lottery_82_app' ),
						6              => esc_html__( 'Six', 'lottery_82_app' ),
						7              => esc_html__( 'Seven', 'lottery_82_app' ),
						8              => esc_html__( 'Eight', 'lottery_82_app' ),
						9              => esc_html__( 'Nine', 'lottery_82_app' ),
						10              => esc_html__( 'Ten', 'lottery_82_app' ),
					),
					'dependency' => $related_dependency
				)

			);

			$options = array_merge( $options, $product_options );

			return $options;

		}

    }
}

_82lottery_Shop_Metabox_Single_Upsell_Related::instance();