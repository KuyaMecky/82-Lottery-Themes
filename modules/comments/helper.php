<?php
add_action( 'lottery_82_app_after_main_css', 'comment_style' );
function comment_style() {
    if ( (class_exists( 'WooCommerce' ) && is_product()) || ( is_singular('post') || is_singular('page') || is_attachment() ) && get_option( 'thread_comments' ) ) {
        wp_enqueue_style( 'lottery_82_app-comments', get_theme_file_uri('/modules/comments/assets/css/comments.css'), false, LOTTERY_82_THEME_VERSION, 'all');
    }
}

if( ! function_exists('include_comments_template') ) {
    function include_comments_template() {
        echo '<section class="commententries rounded">';
            comments_template();
        echo '</section>';
    }

    add_action( 'lottery_82_app_after_single_page_content_wrap', 'include_comments_template' );
}

if( ! function_exists( 'load_comments_template' )  ) {
	function load_comments_template() {
		lottery_82_app_template_part( 'comments', 'templates/comments' );
	}

	add_action( 'lottery_82_app_comments_template', 'load_comments_template' );
}

