<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	if( $archive_readmore_text != '' ) :
		echo '<!-- Entry Button --><div class="entry-button wdt-core-button">';
			echo '<a href="'.get_permalink().'" title="'.the_title_attribute('echo=0').'" class="wdt-button">'.esc_html($archive_readmore_text).'<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve"><path d="M13.7,2.3c-0.2-0.2-0.6-0.4-0.9-0.4c0,0,0,0,0,0l-9.7,0c-0.7,0-1.2,0.6-1.2,1.3c0,0.7,0.6,1.2,1.2,1.2c0,0,0,0,0,0l6.7,0 l-7.2,7.2c-0.5,0.5-0.5,1.3,0,1.8c0.2,0.2,0.6,0.4,0.9,0.4s0.6-0.1,0.9-0.4l7.2-7.2l0,6.7c0,0.7,0.6,1.3,1.2,1.3c0,0,0,0,0,0 c0.7,0,1.2-0.6,1.3-1.2l0-9.7C14.1,2.8,14,2.5,13.7,2.3z"/></svg></span></a>';
		echo '</div><!-- Entry Button -->';
	endif; ?>