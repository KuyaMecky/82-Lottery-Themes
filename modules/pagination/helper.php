<?php
add_action( 'lottery_82_app_after_main_css', 'pagination_style' );
function pagination_style() {
    wp_enqueue_style( 'lottery_82_app-pagination', get_theme_file_uri('/modules/pagination/assets/css/pagination.css'), false, LOTTERY_82_THEME_VERSION, 'all');
}

if( !function_exists( 'after_single_page_content_wp_link_pages' ) ) {

    function after_single_page_content_wp_link_pages() {
        wp_link_pages(array(
            'before'         => '<div class="page-link">',
            'after'          => '</div>',
            'link_before'    => '<span>',
            'link_after'     => '</span>',
            'next_or_number' => 'number',
            'pagelink'       => '%',
        ));

        edit_post_link( esc_html__( ' Edit ','lottery_82_app' ) );
    }

    add_action( 'lottery_82_app_after_single_page_content', 'after_single_page_content_wp_link_pages' );
}

if( !function_exists( 'lottery_82_app_pagination' ) ) {
    function lottery_82_app_pagination( $query = false, $load_more = false ) {

        add_filter( 'number_format_i18n', 'lottery_82_app_zero_prefix' );

        global $wp_query;
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

        // default $wp_query
        if( $query ) {
            $custom_query = $query;
        } else {
            $custom_query = $wp_query;
        }

        $custom_query->query_vars['paged'] > 1 ? $current = $custom_query->query_vars['paged'] : $current = 1;

        if( empty( $paged ) ) $paged = 1;
        $prev = $paged - 1;
        $next = $paged + 1;

        $end_size = 1;
        $mid_size = 2;
        #$show_all = lottery_82_app_get_option( 'showall-pagination' );
        $dots = false;

        if( ! $total = $custom_query->max_num_pages ) $total = 1;

        $output = '';
        if( $total > 1 )
        {
            if( $load_more ){
                // ajax load more -------------------------------------------------
                if( $paged < $total ){
                    $output .= '<div class="column one pager_wrapper pager_lm">';
                        $output .= '<a class="pager_load_more button button_js" href="'. get_pagenum_link( $next ) .'">';
                            $output .= '<span class="button_icon"><i class="icon-layout"></i></span>';
                            $output .= '<span class="button_label">'. esc_html__('Load more', 'lottery_82_app') .'</span>';
                        $output .= '</a>';
                    $output .= '</div>';
                }

            } else {
                // default --------------------------------------------------------
                $output .= '<div class="column one pager_wrapper">';

                    add_filter( 'number_format_i18n', 'lottery_82_app_zero_prefix' );
                    $big = 999999999; // need an unlikely integer
                    $args = array(
                        'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'total'              => $custom_query->max_num_pages,
                        'current'            => max( 1, get_query_var('paged') ),
                        #'show_all'           => $show_all,
                        'end_size'           => $end_size,
                        'mid_size'           => $mid_size,
                        'prev_next'          => true,
                        'prev_text'          => '<span>'.esc_html__('Prev', 'lottery_82_app').'<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve"><path d="M2.1,2.5C2.3,2.3,2.7,2.1,3,2.1l0,0h9.7c0.7,0,1.2,0.6,1.2,1.3s-0.6,1.2-1.2,1.2l0,0H6l7.2,7.2c0.5,0.5,0.5,1.3,0,1.8 C13,13.8,12.6,14,12.3,14s-0.6-0.1-0.9-0.4L4.2,6.4v6.7c0,0.7-0.6,1.3-1.2,1.3l0,0c-0.7,0-1.2-0.6-1.3-1.2V3.5 C1.7,3,1.8,2.7,2.1,2.5z"/></svg></span>',
                        'next_text'          => '<span>'.esc_html__('Next', 'lottery_82_app').'<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve"><path d="M13.4,2.5c-0.2-0.2-0.6-0.4-0.9-0.4l0,0H2.9c-0.7,0-1.2,0.6-1.2,1.3s0.6,1.2,1.2,1.2l0,0h6.7l-7.2,7.2 c-0.5,0.5-0.5,1.3,0,1.8C2.6,13.8,3,14,3.3,14s0.6-0.1,0.9-0.4l7.2-7.2v6.7c0,0.7,0.6,1.3,1.2,1.3l0,0c0.7,0,1.2-0.6,1.3-1.2V3.5 C13.9,3,13.8,2.7,13.4,2.5z"/></svg></span>',
                        'type'               => 'list'
                    );
                    $output .= paginate_links( $args );

                $output .= '</div>'."\n";
            }
        }
        return $output;
    }
}