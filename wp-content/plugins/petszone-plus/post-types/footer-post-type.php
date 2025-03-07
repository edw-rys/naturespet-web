<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (! class_exists ( 'PetsZonePlusFooterPostType' ) ) {

	class PetsZonePlusFooterPostType {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

		function __construct() {

			add_action ( 'init', array( $this, 'petszone_register_cpt' ) );
			add_filter ( 'template_include', array ( $this, 'petszone_template_include' ) );
		}

		function petszone_register_cpt() {

			$labels = array (
				'name'				 => __( 'Footers', 'petszone-plus' ),
				'singular_name'		 => __( 'Footer', 'petszone-plus' ),
				'menu_name'			 => __( 'Footers', 'petszone-plus' ),
				'add_new'			 => __( 'Add Footer', 'petszone-plus' ),
				'add_new_item'		 => __( 'Add New Footer', 'petszone-plus' ),
				'edit'				 => __( 'Edit Footer', 'petszone-plus' ),
				'edit_item'			 => __( 'Edit Footer', 'petszone-plus' ),
				'new_item'			 => __( 'New Footer', 'petszone-plus' ),
				'view'				 => __( 'View Footer', 'petszone-plus' ),
				'view_item' 		 => __( 'View Footer', 'petszone-plus' ),
				'search_items' 		 => __( 'Search Footers', 'petszone-plus' ),
				'not_found' 		 => __( 'No Footers found', 'petszone-plus' ),
				'not_found_in_trash' => __( 'No Footers found in Trash', 'petszone-plus' ),
			);

			$args = array (
				'labels' 				=> $labels,
				'public' 				=> true,
				'exclude_from_search'	=> true,
				'show_in_nav_menus' 	=> false,
				'show_in_rest' 			=> true,
				'menu_position'			=> 26,
				'menu_icon' 			=> 'dashicons-editor-insertmore',
				'hierarchical' 			=> false,
				'supports' 				=> array ( 'title', 'editor', 'revisions' ),
			);

			register_post_type ( 'wdt_footers', $args );
		}

		function petszone_template_include($template) {
			if ( is_singular( 'wdt_footers' ) ) {
				if ( ! file_exists ( get_stylesheet_directory () . '/single-wdt_footers.php' ) ) {
					$template = PETSZONE_PLUS_DIR_PATH . 'post-types/templates/single-wdt_footers.php';
				}
			}

			return $template;
		}
	}
}

PetsZonePlusFooterPostType::instance();