<?php
/**
 * Recommends plugins for use with the theme via the TGMA Script
 *
 * @package _82lottery WordPress theme
 */

function lottery_82_app_tgmpa_plugins_register() {

	// Get array of recommended plugins.
    $theme_required_plugin_lists = array();
    $url = 'https://api.wordpress.org/plugins/info/1.0/unyson';
    $api_response = wp_remote_get( $url );
    if ( is_array( $api_response ) && ! is_wp_error( $api_response ) ) {
        if( isset($api_response['response']) && !empty($api_response['response']) ) {
            if ( 404 == $api_response['response']['code'] && 'Not Found' == $api_response['response']['message'] ) {
                $unyson_plugin = array(
                    array(
                        'name'               => esc_html__('Unyson', 'lottery_82_app'),
                        'slug'               => 'unyson',
                        'source'             => LOTTERY_82_MODULE_DIR . '/plugins/unyson.zip',
                        'required'           => true,
                        'version'            => '2.7.28',
                        'force_activation'   => false,
                        'force_deactivation' => false,
                    )
                );
            } else {
                $unyson_plugin = array(
                    array(
                        'name'     => esc_html__('Unyson', 'lottery_82_app'),
                        'slug'     => 'unyson',
                        'required' => true,
                    )
                );
            }
        }
    }
	$plugins_list = array(
        array(
            'name'               => esc_html__('82-LOTTERY Plus', 'lottery_82_app'),
            'slug'               => 'lottery_82_app-plus',
            'source'             => LOTTERY_82_MODULE_DIR . '/plugins/lottery_82_app-plus.zip',
            'required'           => true,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => esc_html__('82-LOTTERY Pro', 'lottery_82_app'),
            'slug'               => 'lottery_82_app-pro',
            'source'             => LOTTERY_82_MODULE_DIR . '/plugins/lottery_82_app-pro.zip',
            'required'           => true,
            'version'            => '1.0.1',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('Elementor', 'lottery_82_app'),
            'slug'     => 'elementor',
            'required' => true,
        ),
        array(
            'name'               => esc_html__('WeDesignTech Elementor Addon', 'lottery_82_app'),
            'slug'               => 'wedesigntech-elementor-addon',
            'source'             => LOTTERY_82_MODULE_DIR . '/plugins/wedesigntech-elementor-addon.zip',
            'required'           => true,
            'version'            => '1.0.3',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('Qi Addons For Elementor', 'lottery_82_app'),
            'slug'     => 'qi-addons-for-elementor',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('AI Engine: ChatGPT Chatbot, Content Generator', 'lottery_82_app'),
            'slug'     => 'ai-engine',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('Tidio Chat', 'lottery_82_app'),
            'slug'     => 'tidio-live-chat',
            'required' => true,
        ),
        array(
            'name'               => esc_html__('WeDesignTech Portfolio', 'lottery_82_app'),
            'slug'               => 'wedesigntech-portfolio',
            'source'             => LOTTERY_82_MODULE_DIR . '/plugins/wedesigntech-portfolio.zip',
            'required'           => true,
            'version'            => '1.0.1',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('WooCommerce', 'lottery_82_app'),
            'slug'     => 'woocommerce',
            'required' => false,
        ),
        array(
            'name'               => esc_html__('82-LOTTERY Shop', 'lottery_82_app'),
            'slug'               => 'lottery_82_app-shop',
            'source'             => LOTTERY_82_MODULE_DIR . '/plugins/lottery_82_app-shop.zip',
            'required'           => false,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('YITH WooCommerce Wishlist', 'lottery_82_app'),
            'slug'     => 'yith-woocommerce-wishlist',
            'required' => false,
        ),
        array(
            'name'     => esc_html__('YITH WooCommerce Compare', 'lottery_82_app'),
            'slug'     => 'yith-woocommerce-compare',
            'required' => false,
        ),
        array(
            'name'     => esc_html__('Contact Form 7', 'lottery_82_app'),
            'slug'     => 'contact-form-7',
            'required' => true,
        )
	);
    
    $theme_required_plugin_lists = array_merge( $unyson_plugin, $plugins_list );
    $plugins = apply_filters('lottery_82_app_required_plugins_list', $theme_required_plugin_lists);

	// Register notice
	tgmpa( $plugins, array(
		'id'           => 'lottery_82_app_theme',
		'domain'       => 'lottery_82_app',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => true,
		'dismissable'  => true,
	) );

}
add_action( 'tgmpa_register', 'lottery_82_app_tgmpa_plugins_register' );