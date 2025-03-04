<?php
	$template_args['post_ID'] = $ID;
	$template_args['post_Style'] = $Post_Style;
	$template_args = array_merge( $template_args, petszone_single_post_params() ); ?>


    <?php petszone_template_part( 'post', 'templates/'.$Post_Style.'/parts/image', '', $template_args ); ?>

    <!-- Post Meta -->
    <div class="post-meta">

    	<!-- Meta Left -->
    	<div class="meta-left">
			<div class="post-date-comment">
				<?php petszone_template_part( 'post', 'templates/'.$Post_Style.'/parts/date', '', $template_args ); ?>
				<span class="post-meta-divider">/</span>
				<?php petszone_template_part( 'post', 'templates/'.$Post_Style.'/parts/comment', '', $template_args ); ?>
			</div>
    	</div>
		<!-- Meta Left -->
		
    	<!-- Meta Right -->
    	<div class="meta-right">
			<?php petszone_template_part( 'post', 'templates/'.$Post_Style.'/parts/author', '', $template_args ); ?>
    	</div><!-- Meta Right -->


    </div><!-- Post Meta -->

    <!-- Post Dynamic -->
    <?php echo apply_filters( 'petszone_single_post_dynamic_template_part', petszone_get_template_part( 'post', 'templates/'.$Post_Style.'/parts/dynamic', '', $template_args ) ); ?><!-- Post Dynamic -->