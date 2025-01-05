<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
if(  ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
	<!-- Entry Comment -->
		<div class="single-entry-comments">
		<div class="comment-wrap"><?php
			comments_popup_link(
				esc_html__('0 Comments', 'lottery_82_app'),
				esc_html__('1 Comment', 'lottery_82_app'),
				esc_html__('% Comments', 'lottery_82_app'),
				'',
				esc_html__('Comments Off', 'lottery_82_app')
			); ?>
		</div>
	</div><!-- Entry Comment --><?php
}
?>