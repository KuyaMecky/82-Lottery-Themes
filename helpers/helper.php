<?php
if ( ! function_exists( 'lottery_82_app_template_part' ) ) {
	/**
	 * Function that echo module template part.
	 */
	function lottery_82_app_template_part( $module, $template, $slug = '', $params = array() ) {
		echo lottery_82_app_get_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'lottery_82_app_get_template_part' ) ) {
	/**
	 * Function that load module template part.
	 */
	function lottery_82_app_get_template_part( $module, $template, $slug = '', $params = array() ) {

		$file_path = '';
		$html      =  '';

		$template_path = LOTTERY_82_MODULE_DIR . '/' . $module;
		$temp_path = $template_path . '/' . $template;

		if ( ! empty( $temp_path ) ) {
			if ( ! empty( $slug ) ) {
				$file_path = "{$temp_path}-{$slug}.php";
				if ( ! file_exists( $file_path ) ) {
					$file_path = $temp_path . '.php';
				}
			} else {
				$file_path = $temp_path . '.php';
			}
		}

		$file_path = apply_filters( 'lottery_82_app_get_template_plugin_part', $file_path, $module, $template, $slug);

		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		if ( $file_path && file_exists( $file_path ) ) {
			ob_start();
			include( $file_path );
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'lottery_82_app_get_page_id' ) ) {
	function lottery_82_app_get_page_id() {

		$page_id = get_queried_object_id();

		if( is_archive() || is_search() || is_404() || ( is_front_page() && is_home() ) ) {
			$page_id = -1;
		}

		return $page_id;
	}
}

/* Convert hexdec color string to rgb(a) string */
if ( ! function_exists( 'lottery_82_app_hex2rgba' ) ) {
	function lottery_82_app_hex2rgba($color, $opacity = false) {

		$default = 'rgb(0,0,0)';

		if(empty($color)) {
			return $default;
		}

		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		if (strlen($color) == 6) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
				return $default;
		}

		$rgb =  array_map('hexdec', $hex);

		if($opacity){
			if(abs($opacity) > 1) {
				$opacity = 1.0;
			}
			$output = implode(",",$rgb).','.$opacity;
		} else {
			$output = implode(",",$rgb);
		}

		return $output;

	}
}

if ( ! function_exists( 'lottery_82_app_html_output' ) ) {
	function lottery_82_app_html_output( $html ) {
		return apply_filters( 'lottery_82_app_html_output', $html );
	}
}


if ( ! function_exists( 'lottery_82_app_theme_defaults' ) ) {
	/**
	 * Function to load default values
	 */
	function lottery_82_app_theme_defaults() {

		$defaults = array (
			'primary_color' => '#e34d00',
			'primary_color_rgb' => lottery_82_app_hex2rgba('#e34d00', false),
			'secondary_color' => '#1d1c1c',
			'secondary_color_rgb' => lottery_82_app_hex2rgba('#1d1c1c', false),
			'tertiary_color' => '#4b4b4b',
			'tertiary_color_rgb' => lottery_82_app_hex2rgba('#4b4b4b', false),
			'body_bg_color' => '#161313',
			'body_bg_color_rgb' => lottery_82_app_hex2rgba('#161313', false),
			'body_text_color' => '#C4C4C4',
			'body_text_color_rgb' => lottery_82_app_hex2rgba('#C4C4C4', false),
			'headalt_color' => '#FFFFFF',
			'headalt_color_rgb' => lottery_82_app_hex2rgba('#FFFFFF', false),
			'link_color' => '#FFFFFF',
			'link_color_rgb' => lottery_82_app_hex2rgba('#FFFFFF', false),
			'link_hover_color' => '#F24D2B',
			'link_hover_color_rgb' => lottery_82_app_hex2rgba('#F24D2B', false),
			'border_color' => '#7B2A00',
			'border_color_rgb' => lottery_82_app_hex2rgba('#7B2A00', false),
			'accent_text_color' => '#FFFFFF',
			'accent_text_color_rgb' => lottery_82_app_hex2rgba('#FFFFFF', false),

			'body_typo' => array (
				'font-family' => "Readex Pro",
				'font-fallback' => '"Readex Pro", sans-serif',
				'font-weight' => 400,
				'fs-desktop' => 16,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.63,
				'lh-desktop-unit' => ''
			),
			'h1_typo' => array (
				'font-family' => "Readex Pro",
				'font-fallback' => '"Readex Pro", sans-serif',
				'font-weight' => 700,
				'fs-desktop' => 60,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.3,
				'lh-desktop-unit' => ''
			),
			'h2_typo' => array (
				'font-family' => "Readex Pro",
				'font-fallback' => '"Readex Pro", sans-serif',
				'font-weight' => 700,
				'fs-desktop' => 50,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.3,
				'lh-desktop-unit' => ''
			),
			'h3_typo' => array (
				'font-family' => "Readex Pro",
				'font-fallback' => '"Readex Pro", sans-serif',
				'font-weight' => 700,
				'fs-desktop' => 40,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.3,
				'lh-desktop-unit' => ''
			),
			'h4_typo' => array (
				'font-family' => "Readex Pro",
				'font-fallback' => '"Readex Pro", sans-serif',
				'font-weight' => 700,
				'fs-desktop' => 30,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.3,
				'lh-desktop-unit' => ''
			),
			'h5_typo' => array (
				'font-family' => "Readex Pro",
				'font-fallback' => '"Readex Pro", sans-serif',
				'font-weight' => 700,
				'fs-desktop' => 24,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.3,
				'lh-desktop-unit' => ''
			),
			'h6_typo' => array (
				'font-family' => "Readex Pro",
				'font-fallback' => '"Readex Pro", sans-serif',
				'font-weight' => 700,
				'fs-desktop' => 18,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.3,
				'lh-desktop-unit' => ''
			),
			'extra_typo' => array (
				'font-family' => "Readex Pro",
				'font-fallback' => '"Readex Pro", sans-serif',
				'font-weight' => 500,
				'fs-desktop' => 14,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.1,
				'lh-desktop-unit' => ''
			),

		);

		return $defaults;

	}
}

add_filter( 'comment_form_default_fields', 'lottery_82_app_custom_placeholder_comment_section', 10 );
function lottery_82_app_custom_placeholder_comment_section( $fields ) {

    $req = get_option( 'require_name_email' );
    $required_attribute = 'required="required"';
    $required_indicator = '<span class="required" aria-hidden="true">*</span>';

    $fields['author'] = sprintf(
        '<p class="comment-form-author">%s %s</p>',
        sprintf(
            '<input id="author" name="author" type="text" value="%s" size="30" maxlength="245" %s />',
            esc_attr( $commenter['comment_author'] ),
            ( $req ? $required_attribute : '' )
        ),
        sprintf(
            '<label for="author">%s%s</label>',
            esc_html__( 'Name', 'lottery_82_app' ),
            ( $req ? $required_indicator : '' )
        )
    );
    $fields['email'] = sprintf(
        '<p class="comment-form-email">%s %s</p>',
        sprintf(
            '<input id="email" name="email" type="email" value="%s" size="30" maxlength="100" aria-describedby="email-notes"%s />',
            esc_attr( $commenter['comment_author_email'] ),
            ( $req ? $required_attribute : '' )
        ),
        sprintf(
            '<label for="email">%s%s</label>',
            esc_html__( 'Email', 'lottery_82_app' ),
            ( $req ? $required_indicator : '' )
        )
    );
    $fields['url'] = sprintf(
        '<p class="comment-form-url">%s %s</p>',
        sprintf(
            '<input id="url" name="url" type="text" value="%s" size="30" maxlength="200" />',
            esc_attr( $commenter['comment_author_url'] )
        ),
        sprintf(
            '<label for="url">%s</label>',
            esc_html__( 'Website', 'lottery_82_app' )
        )
    );

    return $fields;

}

add_filter( 'comment_form_defaults', 'lottery_82_app_custom_placeholder_textarea_section', 10 );
function lottery_82_app_custom_placeholder_textarea_section( $fields ) {

    $req = get_option( 'require_name_email' );
    $required_attribute = 'required="required"';
    $required_indicator = '<span class="required" aria-hidden="true">*</span>';

    $replace_comment = esc_html__('Enter your comment', 'lottery_82_app');

    $fields['comment_field'] = sprintf(
        '<p class="comment-form-comment">%s %s</p>',
        '<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" ' . $required_attribute . '></textarea>',
        sprintf(
            '<label for="comment">%s%s</label>',
            esc_html__( 'Comment', 'lottery_82_app' ),
            $required_indicator
        )
    );

    return $fields;
}

/* Filter function to be used with number_format_i18n filter hook */
if( ! function_exists( 'lottery_82_app_zero_prefix' ) ) :
    function lottery_82_app_zero_prefix( $format ) {
        $number = intval( $format );
        if( intval( $number / 10 ) > 0 ) {
            return $format;
        }
        return '0' . $format;
    }
endif;