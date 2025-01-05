<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<!-- Entry Author -->
<div class="entry-author">
	<span><?php esc_html_e('By', 'lottery_82_app'); ?></span>
	<?php echo get_avatar( get_the_author_meta( 'ID' ), 25 ); ?>
	<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php esc_attr_e('View all posts by ', 'lottery_82_app'); echo get_the_author();?>">
		<?php echo get_the_author();?>
	</a>
</div><!-- Entry Author -->