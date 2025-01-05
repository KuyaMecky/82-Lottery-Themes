<?php

if( !class_exists( '_82lottery_Loader' ) ) {

    class _82lottery_Loader {

        private static $_instance = null;

        private $theme_defaults = array ();

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            $this->define_constants();
            $this->load_helpers();

            $this->theme_defaults = lottery_82_app_theme_defaults();

            add_action( 'after_setup_theme', array( $this, 'set_theme_support' ) );

            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_js' ), 50 );

            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css' ), 50 );
            add_action( 'wp_enqueue_scripts', array( $this, 'add_inline_style' ), 60 );

            add_action( 'lottery_82_app_before_main_css', array( $this, 'add_google_fonts' ) );

            add_action( 'after_setup_theme', array( $this, 'include_module_helpers' ) );

        }

        function define_constants() {
            define( 'LOTTERY_82_ROOT_DIR', get_template_directory() );
            define( 'LOTTERY_82_ROOT_URI', get_template_directory_uri() );
            define( 'LOTTERY_82_MODULE_DIR', LOTTERY_82_ROOT_DIR.'/modules'  );
            define( 'LOTTERY_82_MODULE_URI', LOTTERY_82_ROOT_URI.'/modules' );
            define( 'LOTTERY_82_LANG_DIR', LOTTERY_82_ROOT_DIR.'/languages' );

            $theme = wp_get_theme();
            define( 'LOTTERY_82_THEME_NAME', $theme->get('Name'));
            define( 'LOTTERY_82_THEME_VERSION', $theme->get('Version'));
        }

        function load_helpers() {
            include_once LOTTERY_82_ROOT_DIR . '/helpers/helper.php';
        }

        function set_theme_support() {
            load_theme_textdomain( 'lottery_82_app', LOTTERY_82_LANG_DIR );
            add_theme_support( 'automatic-feed-links' );
            add_theme_support( 'title-tag' );
            add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
            add_theme_support( 'post-formats', array('status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat'));
            add_theme_support( 'post-thumbnails' );
            add_theme_support( 'custom-logo' );
            add_theme_support( 'custom-background', array( 'default-color' => '#d1e4dd' ) );
            add_theme_support( 'custom-header' );

			add_theme_support( 'align-wide' ); // Gutenberg wide images.
            add_theme_support( 'editor-color-palette', array(
                array(
                    'name'  => esc_html__( 'Primary Color', 'lottery_82_app' ),
                    'slug'  => 'primary',
                    'color'	=> $this->theme_defaults['primary_color'],
                ),
                array(
                    'name'  => esc_html__( 'Secondary Color', 'lottery_82_app' ),
                    'slug'  => 'secondary',
                    'color' => $this->theme_defaults['secondary_color'],
                ),
                array(
                    'name'  => esc_html__( 'Tertiary Color', 'lottery_82_app' ),
                    'slug'  => 'tertiary',
                    'color' => $this->theme_defaults['tertiary_color'],
                ),
                array(
                    'name'  => esc_html__( 'Body Background Color', 'lottery_82_app' ),
                    'slug'  => 'body-bg',
                    'color' => $this->theme_defaults['body_bg_color'],
                ),
                array(
                    'name'  => esc_html__( 'Body Text Color', 'lottery_82_app' ),
                    'slug'  => 'body-text',
                    'color' => $this->theme_defaults['body_text_color'],
                ),
                array(
                    'name'  => esc_html__( 'Alternate Color', 'lottery_82_app' ),
                    'slug'  => 'alternate',
                    'color' => $this->theme_defaults['headalt_color'],
                ),
                array(
                    'name'  => esc_html__( 'Transparent Color', 'lottery_82_app' ),
                    'slug'  => 'transparent',
                    'color' => 'rgba(0,0,0,0)',
                )
            ) );

            add_theme_support( 'editor-styles' );
            add_editor_style( './assets/css/style-editor.css' );

            $GLOBALS['content_width'] = apply_filters( 'lottery_82_app_set_content_width', 1230 );
            register_nav_menus( array(
                'main-menu' => esc_html__('Main Menu', 'lottery_82_app'),
            ) );
        }

        function enqueue_js() {

            wp_enqueue_script('jquery-select2', get_theme_file_uri('/assets/lib/select2/select2.full.js'), array('jquery'), false, true);

            /**
             * Before Hook
             */
            do_action( 'lottery_82_app_before_enqueue_js' );

                wp_enqueue_script('lottery_82_app-jqcustom', get_theme_file_uri('/assets/js/custom.js'), array('jquery'), false, true);

                if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				    wp_enqueue_script( 'comment-reply' );
			    }

            /**
             * After Hook
             */
            do_action( 'lottery_82_app_after_enqueue_js' );

        }

        function enqueue_css() {
            /**
             * Before Hook
             */
            do_action( 'lottery_82_app_before_main_css' );

                wp_enqueue_style( 'lottery_82_app', get_stylesheet_uri(), false, LOTTERY_82_THEME_VERSION, 'all' );
                wp_enqueue_style( 'lottery_82_app-icons', get_theme_file_uri('/assets/css/icons.css'), false, LOTTERY_82_THEME_VERSION, 'all');

                $css = $this->generate_theme_default_css();
                if( !empty( $css ) ) {
                    wp_add_inline_style( 'lottery_82_app', ':root {'.$css.'}' );
                }

                wp_enqueue_style( 'lottery_82_app-base', get_theme_file_uri('/assets/css/base.css'), false, LOTTERY_82_THEME_VERSION, 'all');
                wp_enqueue_style( 'lottery_82_app-grid', get_theme_file_uri('/assets/css/grid.css'), false, LOTTERY_82_THEME_VERSION, 'all');
                wp_enqueue_style( 'lottery_82_app-layout', get_theme_file_uri('/assets/css/layout.css'), false, LOTTERY_82_THEME_VERSION, 'all');
                wp_enqueue_style( 'lottery_82_app-widget', get_theme_file_uri('/assets/css/widget.css'), false, LOTTERY_82_THEME_VERSION, 'all');
                
                if( is_rtl() ) {
                    wp_enqueue_style( 'lottery_82_app-rtl', get_theme_file_uri('/assets/css/rtl.css'), false, LOTTERY_82_THEME_VERSION, 'all');
                }
                
            /**
             * After Hook
             */
            do_action( 'lottery_82_app_after_main_css' );

            wp_enqueue_style( 'jquery-select2', get_theme_file_uri('/assets/lib/select2/select2.css'), false, LOTTERY_82_THEME_VERSION, 'all');

            wp_enqueue_style( 'lottery_82_app-theme', get_theme_file_uri('/assets/css/theme.css'), false, LOTTERY_82_THEME_VERSION, 'all');
        }

        function generate_theme_default_css() {

            $css = '';

            $css .= apply_filters( 'lottery_82_app_primary_color_css_var',  '--wdtPrimaryColor: '.$this->theme_defaults['primary_color'].';' );
            $css .= apply_filters( 'lottery_82_app_primary_rgb_color_css_var',  '--wdtPrimaryColorRgb: '.$this->theme_defaults['primary_color_rgb'].';' );
            $css .= apply_filters( 'lottery_82_app_secondary_color_css_var',  '--wdtSecondaryColor: '.$this->theme_defaults['secondary_color'].';' );
            $css .= apply_filters( 'lottery_82_app_secondary_rgb_color_css_var',  '--wdtSecondaryColorRgb: '.$this->theme_defaults['secondary_color_rgb'].';' );
            $css .= apply_filters( 'lottery_82_app_tertiary_color_css_var',  '--wdtTertiaryColor: '.$this->theme_defaults['tertiary_color'].';' );
            $css .= apply_filters( 'lottery_82_app_tertiary_rgb_color_css_var',  '--wdtTertiaryColorRgb: '.$this->theme_defaults['tertiary_color_rgb'].';' );
            $css .= apply_filters( 'lottery_82_app_body_bg_color_css_var',  '--wdtBodyBGColor: '.$this->theme_defaults['body_bg_color'].';' );
            $css .= apply_filters( 'lottery_82_app_body_bg_rgb_color_css_var',  '--wdtBodyBGColorRgb: '.$this->theme_defaults['body_bg_color_rgb'].';' );
            $css .= apply_filters( 'lottery_82_app_body_text_color_css_var',  '--wdtBodyTxtColor:'.$this->theme_defaults['body_text_color'].';' );
            $css .= apply_filters( 'lottery_82_app_body_text_rgb_color_css_var',  '--wdtBodyTxtColorRgb:'.$this->theme_defaults['body_text_color_rgb'].';' );
            $css .= apply_filters( 'lottery_82_app_headalt_color_css_var',  '--wdtHeadAltColor: '.$this->theme_defaults['headalt_color'].';' );
            $css .= apply_filters( 'lottery_82_app_headalt_rgb_color_css_var',  '--wdtHeadAltColorRgb: '.$this->theme_defaults['headalt_color_rgb'].';' );
            $css .= apply_filters( 'lottery_82_app_link_color_css_var',  '--wdtLinkColor: '.$this->theme_defaults['link_color'].';' );
            $css .= apply_filters( 'lottery_82_app_link_rgb_color_css_var',  '--wdtLinkColorRgb: '.$this->theme_defaults['link_color_rgb'].';' );
            $css .= apply_filters( 'lottery_82_app_link_hover_color_css_var',  '--wdtLinkHoverColor: '.$this->theme_defaults['link_hover_color'].';' );
            $css .= apply_filters( 'lottery_82_app_link_hover_rgb_color_css_var',  '--wdtLinkHoverColorRgb: '.$this->theme_defaults['link_hover_color_rgb'].';' );
            $css .= apply_filters( 'lottery_82_app_border_color_css_var',  '--wdtBorderColor: '.$this->theme_defaults['border_color'].';' );
            $css .= apply_filters( 'lottery_82_app_border_rgb_color_css_var',  '--wdtBorderColorRgb: '.$this->theme_defaults['border_color_rgb'].';' );
            $css .= apply_filters( 'lottery_82_app_accent_text_color_css_var',  '--wdtAccentTxtColor: '.$this->theme_defaults['accent_text_color'].';' );
            $css .= apply_filters( 'lottery_82_app_accent_text_rgb_color_css_var',  '--wdtAccentTxtColorRgb: '.$this->theme_defaults['accent_text_color_rgb'].';' );

            if(isset($this->theme_defaults['body_typo']) && !empty($this->theme_defaults['body_typo'])) {

                $body_typo_css_var = apply_filters( 'lottery_82_app_body_typo_customizer_update',  $this->theme_defaults['body_typo'] );

                $css .=  '--wdtFontTypo_Base: '.$body_typo_css_var['font-fallback'].';';
                $css .=  '--wdtFontWeight_Base: '.$body_typo_css_var['font-weight'].';';
                $css .=  '--wdtFontSize_Base: '.$body_typo_css_var['fs-desktop'].$body_typo_css_var['fs-desktop-unit'].';';
                $css .=  '--wdtLineHeight_Base: '.$body_typo_css_var['lh-desktop'].$body_typo_css_var['lh-desktop-unit'].';';
            }

            if(isset($this->theme_defaults['h1_typo']) && !empty($this->theme_defaults['h1_typo'])) {

                $h1_typo_css_var = apply_filters( 'lottery_82_app_h1_typo_customizer_update',  $this->theme_defaults['h1_typo'] );

                $css .= '--wdtFontTypo_Alt: '.$h1_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_Alt: '.$h1_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_Alt: '.$h1_typo_css_var['fs-desktop'].$h1_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_Alt: '.$h1_typo_css_var['lh-desktop'].$h1_typo_css_var['lh-desktop-unit'].';';

                $css .= '--wdtFontTypo_H1: '.$h1_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_H1: '.$h1_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_H1: '.$h1_typo_css_var['fs-desktop'].$h1_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_H1: '.$h1_typo_css_var['lh-desktop'].$h1_typo_css_var['lh-desktop-unit'].';';

            }

            if(isset($this->theme_defaults['h2_typo']) && !empty($this->theme_defaults['h2_typo'])) {

                $h2_typo_css_var = apply_filters( 'lottery_82_app_h2_typo_customizer_update',  $this->theme_defaults['h2_typo'] );

                $css .= '--wdtFontTypo_H2: '.$h2_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_H2: '.$h2_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_H2: '.$h2_typo_css_var['fs-desktop'].$h2_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_H2: '.$h2_typo_css_var['lh-desktop'].$h2_typo_css_var['lh-desktop-unit'].';';

            }

            if(isset($this->theme_defaults['h3_typo']) && !empty($this->theme_defaults['h3_typo'])) {

                $h3_typo_css_var = apply_filters( 'lottery_82_app_h3_typo_customizer_update',  $this->theme_defaults['h3_typo'] );

                $css .= '--wdtFontTypo_H3: '.$h3_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_H3: '.$h3_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_H3: '.$h3_typo_css_var['fs-desktop'].$h3_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_H3: '.$h3_typo_css_var['lh-desktop'].$h3_typo_css_var['lh-desktop-unit'].';';

            }

            if(isset($this->theme_defaults['h4_typo']) && !empty($this->theme_defaults['h4_typo'])) {

                $h4_typo_css_var = apply_filters( 'lottery_82_app_h4_typo_customizer_update',  $this->theme_defaults['h4_typo'] );

                $css .= '--wdtFontTypo_H4: '.$h4_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_H4: '.$h4_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_H4: '.$h4_typo_css_var['fs-desktop'].$h4_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_H4: '.$h4_typo_css_var['lh-desktop'].$h4_typo_css_var['lh-desktop-unit'].';';

            }

            if(isset($this->theme_defaults['h5_typo']) && !empty($this->theme_defaults['h5_typo'])) {

                $h5_typo_css_var = apply_filters( 'lottery_82_app_h5_typo_customizer_update',  $this->theme_defaults['h5_typo'] );

                $css .= '--wdtFontTypo_H5: '.$h5_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_H5: '.$h5_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_H5: '.$h5_typo_css_var['fs-desktop'].$h5_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_H5: '.$h5_typo_css_var['lh-desktop'].$h5_typo_css_var['lh-desktop-unit'].';';

            }

            if(isset($this->theme_defaults['h6_typo']) && !empty($this->theme_defaults['h6_typo'])) {

                $h6_typo_css_var = apply_filters( 'lottery_82_app_h6_typo_customizer_update',  $this->theme_defaults['h6_typo'] );

                $css .= '--wdtFontTypo_H6: '.$h6_typo_css_var['font-fallback'].';';
                $css .= '--wdtFontWeight_H6: '.$h6_typo_css_var['font-weight'].';';
                $css .= '--wdtFontSize_H6: '.$h6_typo_css_var['fs-desktop'].$h6_typo_css_var['fs-desktop-unit'].';';
                $css .= '--wdtLineHeight_H6: '.$h6_typo_css_var['lh-desktop'].$h6_typo_css_var['lh-desktop-unit'].';';

            }

            if(isset($this->theme_defaults['extra_typo']) && !empty($this->theme_defaults['extra_typo'])) {

                $css .= apply_filters( 'lottery_82_app_typo_font_family_css_var',  '--wdtFontTypo_Ext: '.$this->theme_defaults['extra_typo']['font-fallback'].';' );
                $css .= apply_filters( 'lottery_82_app_typo_font_weight_css_var',  '--wdtFontWeight_Ext: '.$this->theme_defaults['extra_typo']['font-weight'].';' );
                $css .= apply_filters( 'lottery_82_app_typo_fs_desktop_css_var',  '--wdtFontSize_Ext: '.$this->theme_defaults['extra_typo']['fs-desktop'].$this->theme_defaults['extra_typo']['fs-desktop-unit'].';' );
                $css .= apply_filters( 'lottery_82_app_typo_lh_desktop_css_var',  '--wdtLineHeight_Ext: '.$this->theme_defaults['extra_typo']['lh-desktop'].$this->theme_defaults['extra_typo']['lh-desktop-unit'].';' );

            }

            return $css;

        }

        function add_inline_style() {

            wp_register_style( 'lottery_82_app-admin', '', array(), LOTTERY_82_THEME_VERSION, 'all' );
            wp_enqueue_style( 'lottery_82_app-admin' );

            $css = apply_filters( 'lottery_82_app_add_inline_style', $css = '' );

            if( !empty( $css ) ) {
                wp_add_inline_style( 'lottery_82_app-admin', $css );
            }

            /**
             * Responsive CSS
             */

                # Tablet Landscape
                    $tablet_landscape = apply_filters( 'lottery_82_app_add_tablet_landscape_inline_style', $tablet_landscape = '' );
                    if( !empty( $tablet_landscape ) ) {
                        $tablet_landscape = '@media only screen and (min-width:1025px) and (max-width:1280px) {'."\n".$tablet_landscape."\n".'}';
                        wp_add_inline_style( 'lottery_82_app-admin', $tablet_landscape );
                    }

                # Tablet Portrait
                    $tablet_portrait = apply_filters( 'lottery_82_app_add_tablet_portrait_inline_style', $tablet_portrait = '' );
                    if( !empty( $tablet_portrait ) ) {
                        $tablet_portrait = '@media only screen and (min-width:768px) and (max-width:1024px) {'."\n".$tablet_portrait."\n".'}';
                        wp_add_inline_style( 'lottery_82_app-admin', $tablet_portrait );
                    }

                # Mobile
                    $mobile_res = apply_filters( 'lottery_82_app_add_mobile_res_inline_style', $mobile_res = '' );
                    if( !empty( $mobile_res ) ) {
                        $mobile_res = '@media (max-width: 767px) {'."\n".$mobile_res."\n".'}';
                        wp_add_inline_style( 'lottery_82_app-admin', $mobile_res );
                    }

        }

        function add_google_fonts() {
            $subset = apply_filters( 'lottery_82_app_google_font_supsets', 'latin-ext' );
            $fonts  = apply_filters( 'lottery_82_app_google_fonts_list', array(
                'Readex Pro:200,300,400,500,600,700'
            ) );

			foreach( $fonts as $font ) {
				$url = '//fonts.googleapis.com/css?family=' . str_replace( ' ', '+', $font );
                $url .= !empty( $subset ) ? '&subset=' . $subset : '';

				$key = md5( $font . $subset );

				// check that the URL is valid. we're going to use transients to make this faster.
				$url_is_valid = get_transient( $key );

				// transient does not exist
				if ( false === $url_is_valid ) {
					$response = wp_remote_get( 'https:' . $url );
					if ( ! is_array( $response ) ) {
						// the url was not properly formatted,
						// cache for 12 hours and continue to the next field
						set_transient( $key, null, 12 * HOUR_IN_SECONDS );
						continue;
					}

					// check the response headers.
					if ( isset( $response['response'] ) && isset( $response['response']['code'] ) ) {
						if ( 200 == $response['response']['code'] ) {
							// URL was ok
							// set transient to true and cache for a week
							set_transient( $key, true, 7 * 24 * HOUR_IN_SECONDS );
							$url_is_valid = true;
						}
					}
				}

				// If the font-link is valid, enqueue it.
				if ( $url_is_valid ) {
					wp_enqueue_style( $key, $url, null, null );
				}
			}

        }

        function include_module_helpers() {

            /**
             * Before Hook
             */
            do_action( 'lottery_82_app_before_load_module_helpers' );

            foreach( glob( LOTTERY_82_ROOT_DIR. '/modules/*/helper.php'  ) as $helper ) {
                include_once $helper;
            }

            /**
             * After Hook
             */
            do_action( 'lottery_82_app_after_load_module_helpers' );
        }

    }

    _82lottery_Loader::instance();
}