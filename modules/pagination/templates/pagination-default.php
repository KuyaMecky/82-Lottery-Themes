<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<div class="pagination blog-pagination"><?php
    if( get_previous_posts_link() ) {?><div class="newer-posts"><?php
        echo get_previous_posts_link( '<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve"><path d="M2.1,2.5C2.3,2.3,2.7,2.1,3,2.1l0,0h9.7c0.7,0,1.2,0.6,1.2,1.3s-0.6,1.2-1.2,1.2l0,0H6l7.2,7.2c0.5,0.5,0.5,1.3,0,1.8 C13,13.8,12.6,14,12.3,14s-0.6-0.1-0.9-0.4L4.2,6.4v6.7c0,0.7-0.6,1.3-1.2,1.3l0,0c-0.7,0-1.2-0.6-1.3-1.2V3.5 C1.7,3,1.8,2.7,2.1,2.5z"/></svg></span>'.esc_html__(' Newer Posts', 'lottery_82_app') ); ?></div><?php
    }

    if( get_next_posts_link() ){?><div class="older-posts"><?php
        echo get_next_posts_link( esc_html__('Older Posts ', 'lottery_82_app').'<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve"><path d="M13.4,2.5c-0.2-0.2-0.6-0.4-0.9-0.4l0,0H2.9c-0.7,0-1.2,0.6-1.2,1.3s0.6,1.2,1.2,1.2l0,0h6.7l-7.2,7.2 c-0.5,0.5-0.5,1.3,0,1.8C2.6,13.8,3,14,3.3,14s0.6-0.1,0.9-0.4l7.2-7.2v6.7c0,0.7,0.6,1.3,1.2,1.3l0,0c0.7,0,1.2-0.6,1.3-1.2V3.5 C13.9,3,13.8,2.7,13.4,2.5z"/></svg></span>' );?></div><?php
    }
?></div>