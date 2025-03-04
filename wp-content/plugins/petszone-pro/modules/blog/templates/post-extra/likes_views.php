<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<!-- Entry Likes Views -->
<div class="entry-likes-views"><?php

	$post_meta = get_post_meta( $post_ID, '_petszone_post_settings', TRUE );
	$post_meta = is_array( $post_meta ) ? $post_meta  : array(); ?>

    <div class="wdt-like-views">
        <div class="likes petszone_like_btn">
			<i class="wdticon-heart"></i>
            <span><?php
                $lcount = !empty($post_meta['like_count']) ? $post_meta['like_count'] : 0;
                $commenttxt = ($lcount == 0) ? 'Like' : 'Likes';
                echo $lcount . ' ' . $commenttxt;
            ?></span>
        </div>

        <div class="views">
            <?php
            $vcount = !empty(get_comments_number()) ? get_comments_number() : 0;
            $commentText = ($vcount == 1 || $vcount == 0) ? 'Comment' : 'Comments';
            ?>
            <i class="wdticon-eye"></i>
            <span><?php echo esc_html($vcount); ?></span> 
            <span><?php echo esc_html($commentText); ?></span>
        </div>
    </div>
</div><!-- Entry Likes Views -->