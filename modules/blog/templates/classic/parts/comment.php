<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
if( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
	<!-- Entry Comment -->
	<div class="entry-comments"><?php
		comments_popup_link(
			esc_html__('0 Comments', 'lottery_82_app'),
			esc_html__('1 Comment', 'lottery_82_app'),
			esc_html__('% Comments', 'lottery_82_app'),
			'',
			esc_html__('Comments Off', 'lottery_82_app')
		); ?>
	</div><!-- Entry Comment --><?php
}
?>