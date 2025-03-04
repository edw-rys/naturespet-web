<?php

if( !function_exists('petszone_archive_blog_post_defaults') ) {
    function petszone_archive_blog_post_defaults() {
        $defaults = array(
            'post-layout'      => 'entry-grid',
            'post-cover-style' => 'wdt-classic',
            'post-gl-style'    => 'wdt-simple',
            'list-type'        => 'entry-left-thumb',
            'hover-style'      => 'wdt-scaleout',
            'overlay-style'    => 'wdt-default',
            'post-align'       => 'alignnone',
            'post-column'      => 'one-half-column'
        );

        return $defaults;
    }
}

if( !function_exists('petszone_archive_blog_post_misc_defaults') ) {
    function petszone_archive_blog_post_misc_defaults() {
        $defaults = array(
            'enable-equal-height' => 0,
            'enable-no-space' => 0
        );

        return $defaults;
    }
}

if( !function_exists('petszone_archive_blog_post_params_default') ) {
    function petszone_archive_blog_post_params_default() {
        $params = array(
            'enable_post_format'   	 => 0,
            'enable_video_audio' 	 => 1,
            'enable_gallery_slider'  => 1,
            'archive_post_elements'  => array( 'feature_image', 'meta_group', 'title', 'content', 'read_more' ),
            'archive_meta_elements'  => array( 'likes_views', 'author'),
            'archive_readmore_text'  => esc_html__('Read More', 'petszone'),
            'enable_excerpt_text'	 => 1,
            'archive_excerpt_length' => 15,
            'archive_blog_pagination'=> 'pagination-numbered',
            'enable_disqus_comments' => 0,
            'post_disqus_shortname'  => ''
        );

        return $params;
    }
}

if( !function_exists('petszone_archive_blog_post_defaults_filter') ) {
    function petszone_archive_blog_post_defaults_filter() {
        $defaults = petszone_archive_blog_post_defaults();
        return apply_filters( 'petszone_archive_post_cmb_class', $defaults );
    }
}

if( !function_exists('petszone_archive_blog_post_misc_defaults_filter') ) {
    function petszone_archive_blog_post_misc_defaults_filter() {
        $defaults = petszone_archive_blog_post_misc_defaults();
        return apply_filters( 'petszone_archive_post_hld_class', $defaults );
    }
}

if( !function_exists('petszone_archive_blog_post_params') ) {
    function petszone_archive_blog_post_params() {
        $params = petszone_archive_blog_post_params_default();
        return apply_filters( 'petszone_archive_blog_post_params', $params );
    }
}

if( !function_exists('petszone_get_archive_post_combine_class') ) {
	function petszone_get_archive_post_combine_class() {

        $blog_defaults = petszone_archive_blog_post_defaults_filter();

		$combine_class[] = '';

		$post_layout = $blog_defaults['post-layout'];
		$combine_class[] = $post_layout.'-layout';

		if( $post_layout == 'entry-cover' ) {
			$combine_class[] = $blog_defaults['post-cover-style'].'-style';
		} else {
			$combine_class[] = $blog_defaults['post-gl-style'].'-style';
		}

		if( $post_layout == 'entry-list' ) {
			$combine_class[] = $blog_defaults['list-type'];
		}

		$combine_class[] = $blog_defaults['hover-style'].'-hover';
		$combine_class[] = $blog_defaults['overlay-style'].'-overlay';

		if( $post_layout == 'entry-grid' || $post_layout == 'entry-cover' ) {
			$combine_class[] = $blog_defaults['post-align'];
		}

		$post_columns = $blog_defaults['post-column'];
		if( $post_layout == 'entry-list' ) {
			$post_columns = 'one-column';
		}

        switch( $post_columns ):

            default:
			case 'one-column':
				$post_class = "column wdt-one-column wdt-post-entry ";
            break;

            case 'one-half-column':
				$post_class = "column wdt-one-half wdt-post-entry ";
            break;

            case 'one-third-column':
				$post_class = "column wdt-one-third wdt-post-entry ";
            break;

            case 'one-fourth-column':
				$post_class = "column wdt-one-fourth wdt-post-entry ";
            break;
        endswitch;

        $combine_class[] = $post_class;

        return apply_filters( 'petszone_get_archive_post_combine_class', implode( ' ', $combine_class ) );
	}
}

if( !function_exists('petszone_get_archive_post_holder_class') ) {
	function petszone_get_archive_post_holder_class() {

        $blog_defaults = petszone_archive_blog_post_defaults_filter();
        $blog_misc_defaults = petszone_archive_blog_post_misc_defaults_filter();

		$holder_class[] = '';

        $post_layout = $blog_defaults['post-layout'];
        $post_equal_height = $blog_misc_defaults['enable-equal-height'];
        $post_no_space = $blog_misc_defaults['enable-no-space'];

		if( ( $post_layout == 'entry-grid' || $post_layout == 'entry-cover' ) && $post_equal_height ):
			$holder_class[] = 'apply-equal-height';
		elseif( $post_layout == 'entry-grid' || $post_layout == 'entry-cover' ):
			$holder_class[] = 'apply-isotope';
		elseif( $post_layout == 'entry-list' ):
			$holder_class[] = 'apply-isotope';
		endif;

		if( ( $post_layout == 'entry-grid' || $post_layout == 'entry-cover' ) && $post_no_space ):
			$holder_class[] = 'apply-no-space';
		elseif( $post_layout == 'entry-list' ):
			$holder_class[] = '';
		endif;

        return apply_filters( 'petszone_get_archive_post_holder_class', implode( ' ', $holder_class ) );
	}
}

if( !function_exists('petszone_get_archive_post_style') ) {
	function petszone_get_archive_post_style() {

        $blog_defaults = petszone_archive_blog_post_defaults_filter();

        $post_layout = $blog_defaults['post-layout'];

		$post_style = '';
		if( $post_layout == 'entry-cover' ) {
			$post_style = $blog_defaults['post-cover-style'];
		} else {
			$post_style = $blog_defaults['post-gl-style'];
		}

		$post_style = str_replace( 'wdt-', '', $post_style );

		return apply_filters( 'petszone_get_archive_post_style', $post_style );
	}
}

if( !function_exists('petszone_get_archive_post_column') ) {
	function petszone_get_archive_post_column() {

        $blog_defaults = petszone_archive_blog_post_defaults_filter();

		$post_columns = $blog_defaults['post-column'];
		$post_layout = $blog_defaults['post-layout'];

		if( $post_layout == 'entry-list' ) {
			$post_columns = 'one-column';
		}

		return apply_filters( 'petszone_get_archive_post_column', $post_columns );
	}
}

add_filter('post_class', 'petszone_archive_set_post_class', 10, 3);
if( !function_exists('petszone_archive_set_post_class') ) {
    function petszone_archive_set_post_class( $classes, $class, $post_id ) {

        if( is_post_type_archive('post') || is_search() || is_category() || is_tag() || is_home() || is_author() || is_year() || is_month() || is_day() || is_time() || is_tax('post_format') || ( defined('DOING_AJAX') && DOING_AJAX ) ) {
			$post_meta = get_post_meta( $post_id, '_petszone_post_settings', TRUE );
			$post_meta = is_array( $post_meta ) ? $post_meta  : array();

            $post_format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : get_post_format($post_id);
            $classes[] = 'blog-entry';
            $classes[] = !empty( $post_format ) ? 'format-'.$post_format : 'format-standard';

            $blog_params = petszone_archive_blog_post_params();

            if( $blog_params['enable_post_format'] ) {
            	$classes[] = 'has-post-format';
            }

            if( $blog_params['enable_video_audio'] && ( $post_format === 'video' || $post_format === 'audio' ) ) {
            	$classes[] = 'has-post-media';
            }

            if( get_the_title( $post_id ) == '' ) {
                $classes[] = 'post-without-title';
            }
        }

        return $classes;
    }
}

add_action( 'petszone_after_main_css', 'petszone_blog_enqueue_css', 10 );
if( !function_exists( 'petszone_blog_enqueue_css' ) ) {
	function petszone_blog_enqueue_css() {
		wp_enqueue_style( 'wdt-blog', get_theme_file_uri('/modules/blog/assets/css/blog.css'), false, PETSZONE_THEME_VERSION, 'all');

        $post_style = petszone_get_archive_post_style();
        if ( file_exists( get_theme_file_path('/modules/blog/templates/'.$post_style.'/assets/css/blog-archive-'.$post_style.'.css') ) ) {
            wp_enqueue_style( 'wdt-blog-archive-'.$post_style, get_theme_file_uri('/modules/blog/templates/'.$post_style.'/assets/css/blog-archive-'.$post_style.'.css'), false, PETSZONE_THEME_VERSION, 'all');
        }

		wp_enqueue_style( 'jquery-bxslider', get_theme_file_uri('/modules/blog/assets/css/jquery.bxslider.css'), false, PETSZONE_THEME_VERSION, 'all' );
	}
}

add_action( 'petszone_before_enqueue_js', 'petszone_blog_enqueue_js' );
if( !function_exists( 'petszone_blog_enqueue_js' ) ) {
	function petszone_blog_enqueue_js() {

		wp_enqueue_script('isotope-pkgd', get_theme_file_uri('/modules/blog/assets/js/isotope.pkgd.js'), array(), false, true);
		wp_enqueue_script('matchheight', get_theme_file_uri('/modules/blog/assets/js/matchHeight.js'), array(), false, true);
		wp_enqueue_script('jquery-bxslider', get_theme_file_uri('/modules/blog/assets/js/jquery.bxslider.js'), array(), false, true);
		wp_enqueue_script('jquery-fitvids', get_theme_file_uri('/modules/blog/assets/js/jquery.fitvids.js'), array(), false, true);
		wp_enqueue_script('jquery-debouncedresize', get_theme_file_uri('/modules/blog/assets/js/jquery.debouncedresize.js'), array(), false, true);
	}
}

if( !function_exists( 'after_blog_post_content_pagination' ) ) {
    function after_blog_post_content_pagination() {

    	$pagination_template = petszone_archive_blog_post_params();
    	$pagination_template = $pagination_template['archive_blog_pagination'];

        echo apply_filters( 'petszone_blog_archive_pagination', petszone_get_template_part( 'pagination', 'templates/'.$pagination_template ) );
    }
    add_action( 'petszone_after_blog_post_content_wrap', 'after_blog_post_content_pagination' );
}

if( !function_exists( 'petszone_excerpt' ) ) {
	function petszone_excerpt( $limit = NULL ) {

		$limit = !empty($limit) ? $limit : 10;

		$excerpt = explode(' ', get_the_excerpt(), $limit);
		$excerpt = array_filter($excerpt);

		if (!empty($excerpt)) {
			if (count($excerpt) >= $limit) {
				array_pop($excerpt);
				$excerpt = implode(" ", $excerpt).'...';
			} else {
				$excerpt = implode(" ", $excerpt);
			}
			$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
			$excerpt = str_replace('&nbsp;', '', $excerpt);
			if(!empty ($excerpt))
				return "<p>{$excerpt}</p>";
		}
	}
}
add_filter( 'comment_form_default_fields', 'petszone_custom_placeholder_comment_section', 10 );
function petszone_custom_placeholder_comment_section( $fields ) {

    $req = get_option( 'require_name_email' );
    $required_attribute = 'required="required"';
    $required_indicator = '<span class="required" aria-hidden="true">*</span>';

    $fields['author'] = sprintf(
        '<p class="comment-form-author">%s %s</p>',
        sprintf(
            '<input id="author" name="author" type="text" value="%s" size="30" maxlength="245" %s placeholder=" Name *" />',
            esc_attr( isset($commenter['comment_author']) && !empty($commenter['comment_author']) ? $commenter['comment_author'] : '' ),
            ( $req ? $required_attribute : '' )
        ),
        sprintf(
            esc_html__( '', 'petszone' ),
            ( $req ? $required_indicator : '' )
        )
    );
    $fields['email'] = sprintf(
        '<p class="comment-form-email">%s %s</p>',
        sprintf(
            '<input id="email" name="email" type="email" value="%s" size="30" maxlength="100" aria-describedby="email-notes"%s placeholder=" Email *" />',
            esc_attr( isset($commenter['comment_author_email']) && !empty($commenter['comment_author_email']) ? $commenter['comment_author_email'] : '' ),
            ( $req ? $required_attribute : '' )
        ),
        sprintf(
            esc_html__( '', 'petszone' ),
            ( $req ? $required_indicator : '' )
        )
    );
    $fields['url'] = sprintf(
        '<p class="comment-form-url">%s %s</p>',
        sprintf(
            '<input id="url" name="url" type="text" value="%s" size="30" maxlength="200" placeholder=" Website"/>',
            esc_attr( isset($commenter['comment_author_url']) && !empty($commenter['comment_author_url']) ? $commenter['comment_author_url'] : '' )
        ),
        sprintf(
            esc_html__( '', 'petszone' )
        )
    );

    return $fields;

}

add_filter( 'comment_form_defaults', 'petszone_custom_placeholder_textarea_section', 10 );
function petszone_custom_placeholder_textarea_section( $fields ) {

    $req = get_option( 'require_name_email' );
    $required_attribute = 'required="required"';
    $required_indicator = '<span class="required" aria-hidden="true">*</span>';

    $replace_comment = esc_html__('Enter your comment', 'petszone');

    $fields['comment_field'] = sprintf(
        '<p class="comment-form-comment">%s %s</p>',
        '<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" ' . $required_attribute . ' placeholder=" Comment *"></textarea>',
        sprintf(
            esc_html__( '', 'petszone' ),
            $required_indicator
        )
    );

    return $fields;
}