<?php
/**
 * Listing Options - Image Effect
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Woo_Listing_Option_Background_Bgcolor' ) ) {

    class PetsZone_Woo_Listing_Option_Background_Bgcolor extends PetsZone_Woo_Listing_Option_Core {

        private static $_instance = null;

        public $option_slug;

        public $option_name;

        public $option_type;

        public $option_default_value;

        public $option_value_prefix;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {

            $this->option_slug          = 'product-background-bgcolor';
            $this->option_name          = esc_html__('Background - Background Color', 'petszone');
            $this->option_type          = array ( 'html', 'key-css' );
            $this->option_default_value = '';
            $this->option_value_prefix  = 'product-';

            $this->render_backend();
        }

        /**
         * Backend Render
         */
        function render_backend() {
            add_filter( 'petszone_woo_custom_product_template_common_options', array( $this, 'woo_custom_product_template_common_options'), 25, 1 );
        }

        /**
         * Custom Product Templates - Options
         */
        function woo_custom_product_template_common_options( $template_options ) {

            array_push( $template_options, $this->setting_args() );

            return $template_options;
        }

        /**
         * Settings Group
         */
        function setting_group() {
            return 'common';
        }

        /**
         * Setting Args
         */
        function setting_args() {
            $settings            =  array ();
            $settings['id']      =  $this->option_slug;
            $settings['type']    =  'color_picker';
            $settings['title']   =  $this->option_name;
            $settings['default'] =  $this->option_default_value;

            return $settings;
        }
    }

}

if( !function_exists('petszone_woo_listing_option_background_bgcolor') ) {
	function petszone_woo_listing_option_background_bgcolor() {
		return PetsZone_Woo_Listing_Option_Background_Bgcolor::instance();
	}
}

petszone_woo_listing_option_background_bgcolor();