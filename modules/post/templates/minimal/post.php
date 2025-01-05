<?php
	$template_args['post_ID'] = $ID;
	$template_args['post_Style'] = $Post_Style;
	$template_args = array_merge( $template_args, lottery_82_app_single_post_params() ); ?>

    <?php lottery_82_app_template_part( 'post', 'templates/'.$Post_Style.'/parts/image', '', $template_args ); ?>

    <!-- Post Dynamic -->
    <?php echo apply_filters( 'lottery_82_app_single_post_dynamic_template_part', lottery_82_app_get_template_part( 'post', 'templates/'.$Post_Style.'/parts/dynamic', '', $template_args ) ); ?><!-- Post Dynamic -->