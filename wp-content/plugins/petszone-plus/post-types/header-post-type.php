<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (! class_exists ( 'PetsZonePlusHeaderPostType' ) ) {

	class PetsZonePlusHeaderPostType {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

		function __construct() {

			add_action ( 'init', array( $this, 'petszone_register_cpt' ), 5 );
			add_filter ( 'template_include', array ( $this, 'petszone_template_include' ) );
		}

		function petszone_register_cpt() {

			$labels = array (
				'name'				 => __( 'Headers', 'petszone-plus' ),
				'singular_name'		 => __( 'Header', 'petszone-plus' ),
				'menu_name'			 => __( 'Headers', 'petszone-plus' ),
				'add_new'			 => __( 'Add Header', 'petszone-plus' ),
				'add_new_item'		 => __( 'Add New Header', 'petszone-plus' ),
				'edit'				 => __( 'Edit Header', 'petszone-plus' ),
				'edit_item'			 => __( 'Edit Header', 'petszone-plus' ),
				'new_item'			 => __( 'New Header', 'petszone-plus' ),
				'view'				 => __( 'View Header', 'petszone-plus' ),
				'view_item' 		 => __( 'View Header', 'petszone-plus' ),
				'search_items' 		 => __( 'Search Headers', 'petszone-plus' ),
				'not_found' 		 => __( 'No Headers found', 'petszone-plus' ),
				'not_found_in_trash' => __( 'No Headers found in Trash', 'petszone-plus' ),
			);

			$args = array (
				'labels' 				=> $labels,
				'public' 				=> true,
				'exclude_from_search'	=> true,
				'show_in_nav_menus' 	=> false,
				'show_in_rest' 			=> true,
				'menu_position'			=> 25,
				'menu_icon' 			=> 'dashicons-heading',
				'hierarchical' 			=> false,
				'supports' 				=> array ( 'title', 'editor', 'revisions' ),
			);

			register_post_type ( 'wdt_headers', $args );
		}

		function petszone_template_include($template) {
			if ( is_singular( 'wdt_headers' ) ) {
				if ( ! file_exists ( get_stylesheet_directory () . '/single-wdt_headers.php' ) ) {
					$template = PETSZONE_PLUS_DIR_PATH . 'post-types/templates/single-wdt_headers.php';
				}
			}

			return $template;
		}
	}
}

PetsZonePlusHeaderPostType::instance();