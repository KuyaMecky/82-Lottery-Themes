<?php
add_action( 'lottery_82_app_after_main_css', 'footer_style' );
function footer_style() {
    wp_enqueue_style( 'lottery_82_app-footer', get_theme_file_uri('/modules/footer/assets/css/footer.css'), false, LOTTERY_82_THEME_VERSION, 'all');
}

add_action( 'lottery_82_app_footer', 'footer_content' );
function footer_content() {
    lottery_82_app_template_part( 'content', 'content', 'footer' );
}

add_action( 'lottery_82_app_before_enqueue_js', 'lottery_82_app_sticky_footer_js' );
if( !function_exists( 'lottery_82_app_sticky_footer_js' ) ) {
    function lottery_82_app_sticky_footer_js() {
        wp_enqueue_script('sticky-footer', get_theme_file_uri('/modules/footer/assets/js/footer.js'), array(), false, true);
    }
}