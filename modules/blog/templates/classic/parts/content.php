<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php if( $enable_excerpt_text && $archive_excerpt_length > 0 ) : ?>
	<div class="entry-body"><?php echo lottery_82_app_excerpt( $archive_excerpt_length );?></div>
<?php endif; ?>