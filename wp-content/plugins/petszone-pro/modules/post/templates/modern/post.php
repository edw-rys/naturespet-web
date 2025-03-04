<?php
	$template_args['post_ID'] = $ID;
	$template_args['post_Style'] = $Post_Style;
	$template_args = array_merge( $template_args, petszone_single_post_params() ); ?>

    <?php
    petszone_template_part( 'post', 'templates/'.$Post_Style.'/parts/category', '', $template_args );
    if( $template_args['enable_title'] ) :
        petszone_template_part( 'post', 'templates/post-extra/title', '', $template_args );
    endif;

    petszone_template_part( 'post', 'templates/'.$Post_Style.'/parts/author_bio', '', $template_args );

    petszone_template_part( 'post', 'templates/post-extra/content', '', $template_args );
    ?>

    <!-- Post Meta -->
    <div class="post-meta">
    	<!-- Meta Left -->
    	<div class="meta-left">
			<?php petszone_template_part( 'post', 'templates/'.$Post_Style.'/parts/author', '', $template_args ); ?>
    	</div><!-- Meta Left -->
    	<!-- Meta Right -->
    	<div class="meta-right">
			<?php petszone_template_part( 'post', 'templates/'.$Post_Style.'/parts/social', '', $template_args ); ?>
        </div>
    </div><!-- Post Meta -->

    <!-- Post Dynamic -->
    <?php echo apply_filters( 'petszone_single_post_dynamic_template_part', petszone_get_template_part( 'post', 'templates/'.$Post_Style.'/parts/dynamic', '', $template_args ) ); ?><!-- Post Dynamic -->