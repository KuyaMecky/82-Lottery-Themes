<?php

if( ! function_exists('lottery_82_app_event_breadcrumb_title') ) {
    function lottery_82_app_event_breadcrumb_title($title) {
        if( get_post_type() == 'tribe_events' && is_single()) {
            $etitle = esc_html__( 'Event Detail', 'lottery_82_app' );
            return '<h1>'.$etitle.'</h1>';
        } else {
            return $title;
        }
    }

    add_filter( 'lottery_82_app_breadcrumb_title', 'lottery_82_app_event_breadcrumb_title', 20, 1 );
}

?>