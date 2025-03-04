<?php
/**
 * Listing Options - Image Effect
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Woo_Listing_Option_Border_Shadow' ) ) {

    class PetsZone_Woo_Listing_Option_Border_Shadow extends PetsZone_Woo_Listing_Option_Core {

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

            $this->option_slug          = 'product-borderorshadow';
            $this->option_name          = esc_html__('Border or Shadow', 'petszone');
            $this->option_type          = array ( 'class', 'value-css' );
            $this->option_default_value = '';
            $this->option_value_prefix  = 'product-borderorshadow-';

            $this->render_backend();
        }

        /**
         * Backend Render
         */
        function render_backend() {
            add_filter( 'petszone_woo_custom_product_template_common_options', array( $this, 'woo_custom_product_template_common_options'), 35, 1 );
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
            $settings['type']    =  'select';
            $settings['title']   =  $this->option_name;
            $settings['options'] =  array (
                ''                              => esc_html__('None', 'petszone'),
                'product-borderorshadow-border' => esc_html__('Border', 'petszone'),
                'product-borderorshadow-shadow' => esc_html__('Shadow', 'petszone'),
            );
            $settings['default'] =  $this->option_default_value;
            $settings['desc']    =  esc_html__('Choose either Border or Shadow for your product listing.', 'petszone');

            return $settings;
        }
    }

}

if( !function_exists('petszone_woo_listing_option_borderorshadow') ) {
	function petszone_woo_listing_option_borderorshadow() {
		return PetsZone_Woo_Listing_Option_Border_Shadow::instance();
	}
}

petszone_woo_listing_option_borderorshadow();