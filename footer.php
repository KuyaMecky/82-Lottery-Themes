                    <?php do_action( 'lottery_82_app_hook_sections_after' ); ?>
                </div><!-- ** Container End ** -->
            </div><!-- **Main - End ** -->

            <?php do_action( 'lottery_82_app_hook_content_after' ); ?>

            <!-- **Footer** -->
            <?php do_action( 'lottery_82_app_footer' ); ?>
            <!-- **Footer - End** -->
        </div><!-- **Inner Wrapper - End** -->

    </div><!-- **Wrapper - End** -->

    <?php
        // Hook to add additional content before body tag closed.
        do_action( 'lottery_82_app_hook_bottom' );
	    wp_footer(); ?>
</body>
</html>