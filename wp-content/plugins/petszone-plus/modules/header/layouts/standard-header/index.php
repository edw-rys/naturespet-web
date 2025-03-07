<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZonePlusStandardHeader' ) ) {
    class PetsZonePlusStandardHeader {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            add_filter( 'petszone_header_layouts', array( $this, 'add_standard_header_option' ) );
            add_filter( 'petszone_default_menu_args', array( $this, 'wp_nav_menu_arg' ) );
        }

        function add_standard_header_option( $options ) {
            $options['standard-header'] = esc_html__('Standard Header', 'petszone-plus');
            return $options;
        }

        function wp_nav_menu_arg( $args ) {
            $args[ 'walker' ] = new PetsZone_Walker_Nav_Menu;
            return $args;
        }
    }
}

PetsZonePlusStandardHeader::instance();