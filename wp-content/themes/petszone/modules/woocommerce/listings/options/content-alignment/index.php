<?php
/**
 * Listing Options - Image Effect
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Woo_Listing_Option_Content_Alignment' ) ) {

    class PetsZone_Woo_Listing_Option_Content_Alignment extends PetsZone_Woo_Listing_Option_Core {

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

            $this->option_slug          = 'product-content-alignment';
            $this->option_name          = esc_html__('Alignment', 'petszone');
            $this->option_type          = array ( 'class', 'value-css' );
            $this->option_default_value = 'product-content-alignment-left';
            $this->option_value_prefix  = 'product-content-alignment-';

            $this->render_backend();
        }

        /**
         * Backend Render
         */
        function render_backend() {
            add_filter( 'petszone_woo_custom_product_template_content_options', array( $this, 'woo_custom_product_template_content_options'), 15, 1 );
        }

        /**
         * Custom Product Templates - Options
         */
        function woo_custom_product_template_content_options( $template_options ) {

            array_push( $template_options, $this->setting_args() );

            return $template_options;
        }

        /**
         * Settings Group
         */
        function setting_group() {
            return 'content';
        }

        /**
         * Setting Args
         */
        function setting_args() {
            $settings            =  array ();
            $settings['id']      =  $this->option_slug;
            $settings['type']    =  'select';
            $settings['title']   =  $this->option_name;
            $settings['options'] =  array (
                'product-content-alignment-left'   => esc_html__('Left', 'petszone'),
                'product-content-alignment-center' => esc_html__('Center', 'petszone'),
                'product-content-alignment-right'  => esc_html__('Right', 'petszone')
            );
            $settings['default'] =  $this->option_default_value;

            return $settings;
        }
    }

}

if( !function_exists('petszone_woo_listing_option_content_alignment') ) {
	function petszone_woo_listing_option_content_alignment() {
		return PetsZone_Woo_Listing_Option_Content_Alignment::instance();
	}
}

petszone_woo_listing_option_content_alignment();