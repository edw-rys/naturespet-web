<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZonePlusSiteLoaderOne' ) ) {
    class PetsZonePlusSiteLoaderOne {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            add_filter( 'petszone_loader_layouts', array( $this, 'add_option' ) );

            $site_loader = petszone_customizer_settings( 'site_loader' );

            if( $site_loader == 'loader-1' ) {

                add_action( 'petszone_after_main_css', array( $this, 'enqueue_assets' ) );

                /**
                 * filter: petszone_primary_color_style - to use primary color
                 * filter: petszone_secondary_color_style - to use secondary color
                 * filter: petszone_tertiary_color_style - to use tertiary color
                 */
                add_filter( 'petszone_tertiary_color_style', array( $this, 'tertiary_color_style' ) );
            }
        }

        function add_option( $options ) {
            $options['loader-1'] = esc_html__('Loader 1', 'petszone-plus');
            return $options;
        }

        function enqueue_assets() {
            wp_enqueue_style( 'site-loader', PETSZONE_PLUS_DIR_URL . 'modules/site-loader/layouts/loader-1/assets/css/loader-1.css', false, PETSZONE_PLUS_VERSION, 'all' );
        }

        function tertiary_color_style( $style ) {
            $style .= ".loader1 { background-color:var( --wdtBodyBGColor );}";
            return $style;
        }
    }
}

PetsZonePlusSiteLoaderOne::instance();