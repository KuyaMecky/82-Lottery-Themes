<?php
$sidebar_class   = lottery_82_app_get_secondary_classes();
$active_sidebars = lottery_82_app_get_active_sidebars();

if( $sidebar_class == 'content-full-width' || $sidebar_class == '' ) {
    return;
}

if( empty( $active_sidebars ) ) {
    return;
}?>
<!-- Secondary -->
<section id="secondary" class="<?php echo esc_attr( $sidebar_class ); ?>"><?php
    do_action( 'lottery_82_app_before_single_sidebar_wrap' );

    get_sidebar();

    do_action( 'lottery_82_app_after_single_sidebar_wrap' );?>
</section><!-- Secondary End -->