<?php

    add_action( 'lottery_82_app_after_main_css', 'search_style' );
    function search_style() {
        wp_enqueue_style( 'lottery_82_app-quick-search', get_theme_file_uri('/modules/search/assets/css/search.css'), false, LOTTERY_82_THEME_VERSION, 'all');
    }

    add_action('wp_ajax_lottery_82_app_search_data_fetch' , 'lottery_82_app_search_data_fetch');
	add_action('wp_ajax_nopriv_lottery_82_app_search_data_fetch','lottery_82_app_search_data_fetch');
	function lottery_82_app_search_data_fetch(){

        $search_val = lottery_82_app_sanitization($_POST['search_val']);

        $the_query = new WP_Query( array( 'posts_per_page' => 5, 's' => $search_val, 'post_type' => array('post', 'product') ) );
        if( $the_query->have_posts() ) :
            while( $the_query->have_posts() ): $the_query->the_post(); ?>
                <li class="quick_search_data_item">
                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                        <?php the_post_thumbnail( 'thumbnail', array( 'class' => ' ' ) ); ?>
                        <?php the_title();?>
                    </a>
                </li>
            <?php endwhile;
            wp_reset_postdata();
        else:
            echo'<p>'. esc_html__( 'No Results Found', 'lottery_82_app') .'</p>';
        endif;

        die();
}

?>