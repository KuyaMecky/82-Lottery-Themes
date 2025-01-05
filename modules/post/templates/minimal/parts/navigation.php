<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<!-- Entry Navigation -->
<div class="entry-post-navigation"><?php
	$prev_post = get_previous_post();
	if( !empty( $prev_post ) ):	?>

		<div class="post-prev-link"><?php
			if( has_post_thumbnail( $prev_post->ID ) ):
				$entry_bg = '';
				$url = get_the_post_thumbnail_url( $prev_post->ID, 'full' );
				$entry_bg = "style=background-image:url(".$url.")"; ?>

				<a href="<?php echo get_permalink( $prev_post->ID ); ?>" <?php echo esc_attr($entry_bg);?> class="prev-post-bgimg"></a><?php
			endif; ?>

			<div class="nav-title-wrap">
				<h3><a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo esc_attr($prev_post->post_title); ?>"><?php
						if( get_the_title( $prev_post->ID ) == '') {
							echo esc_html__('Previous Blog', 'lottery_82_app');
						} else {
							echo "$prev_post->post_title";
						} ?></a>
					</h3>
				<p><a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo esc_attr($prev_post->post_title); ?>"><?php esc_html_e('Previous Blog','lottery_82_app'); ?><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve"> <path d="M2.1,2.5C2.3,2.3,2.7,2.1,3,2.1l0,0h9.7c0.7,0,1.2,0.6,1.2,1.3s-0.6,1.2-1.2,1.2l0,0H6l7.2,7.2c0.5,0.5,0.5,1.3,0,1.8 C13,13.8,12.6,14,12.3,14s-0.6-0.1-0.9-0.4L4.2,6.4v6.7c0,0.7-0.6,1.3-1.2,1.3l0,0c-0.7,0-1.2-0.6-1.3-1.2V3.5	C1.7,3,1.8,2.7,2.1,2.5z"/></svg></a></p>
			</div>

		</div>
		<?php
	else: ?>
		<div class="post-prev-link no-post">
            <a href="#" style="background-image:url(<?php echo esc_url(LOTTERY_82_ROOT_URI.'/assets/images/no-post.jpg') ?>);" class="prev-post-bgimg"></a>
			<div class="nav-title-wrap">
				<h3><?php echo esc_html__('No previous blog to show!', 'lottery_82_app'); ?></h3>
			</div>
		</div>
		<?php
	endif;

	$next_post = get_next_post();
	if( !empty( $next_post ) ):	?>
		<div class="post-next-link"><?php

			if( has_post_thumbnail( $next_post->ID ) ):
				$entry_bg = '';
				$url = get_the_post_thumbnail_url( $next_post->ID, 'full' );
				$entry_bg = "style=background-image:url(".$url.")"; ?>

				<a href="<?php echo get_permalink( $next_post->ID ); ?>" <?php echo esc_attr($entry_bg);?> class="next-post-bgimg"></a><?php
			endif; ?>

			<div class="nav-title-wrap">
				<h3><a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo esc_attr($next_post->post_title); ?>"><?php
						if(get_the_title( $next_post->ID ) == '') {
							echo esc_html__('Next Blog', 'lottery_82_app');
						} else {
							echo "$next_post->post_title";
						} ?></a>
					</h3>
				<p><a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo esc_attr($next_post->post_title); ?>"><?php esc_html_e('Next Blog','lottery_82_app'); ?><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve"> <path d="M13.4,2.5c-0.2-0.2-0.6-0.4-0.9-0.4l0,0H2.9c-0.7,0-1.2,0.6-1.2,1.3s0.6,1.2,1.2,1.2l0,0h6.7l-7.2,7.2 c-0.5,0.5-0.5,1.3,0,1.8C2.6,13.8,3,14,3.3,14s0.6-0.1,0.9-0.4l7.2-7.2v6.7c0,0.7,0.6,1.3,1.2,1.3l0,0c0.7,0,1.2-0.6,1.3-1.2V3.5 C13.9,3,13.8,2.7,13.4,2.5z"/></svg></a></p>
			</div>

		</div>
		<?php
	else: ?>
		<div class="post-next-link no-post">
            <a href="#" style="background-image:url(<?php echo esc_url(LOTTERY_82_ROOT_URI.'/assets/images/no-post.jpg') ?>);" class="next-post-bgimg"></a>
			<div class="nav-title-wrap">
				<h3><?php echo esc_html__('No next blog to show!', 'lottery_82_app'); ?></h3>
			</div>
		</div>
		<?php
	endif; ?>
</div><!-- Entry Navigation -->