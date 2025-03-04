<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZoneProPostMinimal' ) ) {
    class PetsZoneProPostMinimal {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            add_filter( 'petszone_post_styles', array( $this, 'add_post_styles_option' ) );
        }

        function add_post_styles_option( $options ) {
            $options['minimal'] = esc_html__('Minimal', 'petszone-pro');
            return $options;
        }

    }
}

PetsZoneProPostMinimal::instance();