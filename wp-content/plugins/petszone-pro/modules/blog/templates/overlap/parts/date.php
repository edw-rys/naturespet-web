<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<!-- Entry Date -->
<div class="entry-date">
	<?php echo esc_html__('on ', 'petszone-pro').get_the_date ( get_option('date_format') ).esc_html__(' at ', 'petszone-pro').get_the_time('', $post_ID); ?>
</div><!-- Entry Date -->