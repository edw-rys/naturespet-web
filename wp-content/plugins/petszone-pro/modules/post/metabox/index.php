<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'MetaboxPostOptions' ) ) {
    class MetaboxPostOptions {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            add_filter( 'cs_metabox_options', array( $this, 'post_options' ) );
            add_filter( 'cs_metabox_options', array( $this, 'header_footer_options' ) );
			add_action( 'template_redirect', array( $this, 'register_templates' ) );
        }

        function post_options( $options ) {

            $post_types = apply_filters( 'petszone_post_options_post', array( 'post' ) );

            $options[] = array(
                'id'        => '_petszone_post_settings',
                'title'     => esc_html('Post Options', 'petszone-pro'),
                'post_type' => $post_types,
                'context'   => 'advanced',
                'priority'  => 'high',
                'sections'  => array(
                    array(
                        'name'   => 'post_options_section',
                        'fields' => array(
							array(
								'id'         => 'single_post_style',
								'type'       => 'select',
								'title'      => esc_html__('Post Style', 'petszone-pro'),
								'options'    => apply_filters( 'petszone_post_styles', array() ),
								'class'      => 'chosen',
								'default'    => 'minimal',
								'attributes' => array(
									'style'  => 'width: 25%;'
								),
								'info'       => esc_html__('Choose post style to display single post.', 'petszone-pro')
							),
							array(
								'id'         => 'view_count',
							    'type'       => 'number',
							    'title'      => esc_html__('Views', 'petszone-pro' ),
								'info'       => esc_html__('No.of views of this post.', 'petszone-pro'),
								'attributes' => array(
									'style'  => 'width: 15%;'
								),
							),
							array(
								'id'         => 'like_count',
							    'type'       => 'number',
							    'title'      => esc_html__('Likes', 'petszone-pro' ),
								'info'       => esc_html__('No.of likes of this post.', 'petszone-pro'),
								'attributes' => array(
									'style'  => 'width: 15%;'
								),
							),
							array(
								'id' 		 => 'post-format-type',
								'title'   	 => esc_html__('Type', 'petszone-pro' ),
								'type' 		 => 'select',
								'default' 	 => 'standard',
								'options' 	 => array(
								 'standard'  => esc_html__('Standard', 'petszone-pro'),
								 'status'	 => esc_html__('Status','petszone-pro'),
								 'quote'	 => esc_html__('Quote','petszone-pro'),
								 'gallery'	 => esc_html__('Gallery','petszone-pro'),
								 'image'	 => esc_html__('Image','petszone-pro'),
								 'video'	 => esc_html__('Video','petszone-pro'),
								 'audio'	 => esc_html__('Audio','petszone-pro'),
								 'link'		 => esc_html__('Link','petszone-pro'),
								 'aside'	 => esc_html__('Aside','petszone-pro'),
								 'chat'		 => esc_html__('Chat','petszone-pro')
								),
								'class'      => 'chosen',
								'attributes' => array(
									'style'  => 'width: 25%;'
								),
								'info'       => esc_html__('Post Format & Type should be Same. Check the Post Format from the "Format" Tab, which comes in the Right Side Section.', 'petszone-pro'),
							),
							array(
								'id' 	 	 => 'post-gallery-items',
								'type'	 	 => 'gallery',
								'title'   	 => esc_html__('Add Images', 'petszone-pro' ),
								'add_title'  => esc_html__('Add Images', 'petszone-pro' ),
								'edit_title' => esc_html__('Edit Images', 'petszone-pro' ),
								'clear_title'=> esc_html__('Remove Images', 'petszone-pro' ),
								'dependency' => array( 'post-format-type', '==', 'gallery' ),
							),
							array(
								'id' 	  	 => 'media-type',
								'type'	  	 => 'select',
								'title'   	 => esc_html__('Select Type', 'petszone-pro' ),
								'dependency' => array( 'post-format-type', 'any', 'video,audio' ),
						      	'options'	 => array(
						      		'oembed' => esc_html__('Oembed','petszone-pro'),
						      		'self'   => esc_html__('Self Hosted','petszone-pro'),
								)
							),
							array(
								'id' 	  	 => 'media-url',
								'type'	  	 => 'textarea',
								'title'   	 => esc_html__('Media URL', 'petszone-pro' ),
								'dependency' => array( 'post-format-type', 'any', 'video,audio' ),
							),
							array(
								'id'         => 'fieldset_link',
						        'type'       => 'fieldset',
						        'title'      => esc_html__('Link Values', 'petszone-pro'),
						        'fields'     => array(
						        	array(
						        	 'id'    => 'fieldset_link_title',
						        	 'type'  => 'text',
						        	 'title' => esc_html__('Link Text', 'petszone-pro'),
						            ),
						            array(
						             'id'    => 'fieldset_link_url',
						             'type'  => 'text',
						             'title' => esc_html__('URL', 'petszone-pro'),
						            ),
						        ),
						        'dependency' => array( 'post-format-type', '==', 'link' ),
						    ),
                        )
                    )
                )
            );

            return $options;
        }

        function header_footer_options( $options ) {

        	$post_types = apply_filters( 'petszone_header_footer_posts', array( 'post', 'page' ) );

			$options[] = array(
				'id'        => '_petszone_custom_settings',
				'title'     => esc_html__('Header & Footer', 'petszone-pro'),
				'post_type' => $post_types,
				'priority'  => 'high',
				'context'   => 'side',
				'sections'  => array(
					array(
						'name'   => 'header_section',
						'title'  => esc_html__('Header', 'petszone-pro'),
						'icon'   => 'fa fa-angle-double-right',
						'fields' =>  array(
							array(
								'id'      => 'show-header',
								'type'    => 'switcher',
								'title'   => esc_html__('Show Header', 'petszone-pro'),
								'default' =>  true,
							),
							array(
								'id'  		 => 'header',
								'type'  	 => 'select',
								'title' 	 => esc_html__('Choose Header', 'petszone-pro'),
								'class'		 => 'chosen',
								'options'	 => 'posts',
								'query_args' => array(
									'post_type'      => 'wdt_headers',
									'orderby'        => 'ID',
									'order'          => 'ASC',
									'posts_per_page' => -1,
								),
								'default_option' => esc_attr__('Select Header', 'petszone-pro'),
								'attributes'     => array( 'style'	=> 'width:50%' ),
								'info'           => esc_html__('Select custom header for this page.','petszone-pro'),
								'dependency'     => array( 'show-header', '==', 'true' )
							),
						)
					),

					array(
						'name'   => 'footer_settings',
						'title'  => esc_html__('Footer', 'petszone-pro'),
						'icon'   => 'fa fa-angle-double-right',
						'fields' =>  array(
							array(
								'id'      => 'show-footer',
								'type'    => 'switcher',
								'title'   => esc_html__('Show Footer', 'petszone-pro'),
								'default' =>  true,
							),
					        array(
								'id'         => 'footer',
								'type'       => 'select',
								'title'      => esc_html__('Choose Footer', 'petszone-pro'),
								'class'      => 'chosen',
								'options'    => 'posts',
								'query_args' => array(
									'post_type'      => 'wdt_footers',
									'orderby'        => 'ID',
									'order'          => 'ASC',
									'posts_per_page' => -1,
								),
								'default_option' => esc_attr__('Select Footer', 'petszone-pro'),
								'attributes'     => array( 'style'  => 'width:50%' ),
								'info'           => esc_html__('Select custom footer for this page.','petszone-pro'),
								'dependency'     => array( 'show-footer', '==', 'true' )
							),
							array(
								'id'      => 'show-fixed-footer',
								'type'    => 'switcher',
								'title'   => esc_html__('Show Fixed Footer', 'petszone-pro'),
								'default' =>  false,
								'dependency'=> array( 'show-footer', '==', 'true' )
							),
						)
					),
				)
			);

			return $options;
        }

		function register_templates() {
			if( is_singular() ) {
				add_filter( 'petszone_header_get_template_part', array( $this, 'register_header_template' ), 50 );
            	add_filter( 'petszone_footer_get_template_part', array( $this, 'register_footer_template' ), 50 );
			}
        }

        function register_header_template( $template ) {

        	$header_type = petszone_customizer_settings( 'site_header' );

        	if( is_singular() ) {

        		global $post;

                $settings = get_post_meta( $post->ID, '_petszone_custom_settings', TRUE );
                $settings = is_array( $settings ) ? $settings  : array();

                if( array_key_exists( 'show-header', $settings ) && ! $settings['show-header'] )
                    return;

                $id = isset( $settings['header'] ) ? $settings['header'] : -1;

				if( $id > 0 ) {
                	return apply_filters( 'petszone_print_header_template', $id );
				}

        	}

			return  $template;

        }

        function register_footer_template( $template ) {

        	$footer_type = petszone_customizer_settings( 'site_footer' );

        	if( is_singular() ) {

        		global $post;

                $settings = get_post_meta( $post->ID, '_petszone_custom_settings', TRUE );
                $settings = is_array( $settings ) ? $settings  : array();

                if( array_key_exists( 'show-footer', $settings ) && ! $settings['show-footer'] )
                    return;

                $id = isset( $settings['footer'] ) ? $settings['footer'] : -1;

				if( $id > 0 ) {
                	return apply_filters( 'petszone_print_footer_template', $id );
				}

        	}

			return  $template;

        }
    }
}

MetaboxPostOptions::instance();