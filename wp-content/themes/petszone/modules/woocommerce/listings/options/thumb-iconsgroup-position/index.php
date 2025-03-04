<?php
/**
 * Listing Options - Image Effect
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Woo_Listing_Option_Thumb_Icon_Group_Position' ) ) {

    class PetsZone_Woo_Listing_Option_Thumb_Icon_Group_Position extends PetsZone_Woo_Listing_Option_Core {

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

            $this->option_slug          = 'product-thumb-iconsgroup-position';
            $this->option_name          = esc_html__('Icons Group - Position', 'petszone');
            $this->option_type          = array ( 'class', 'value-css' );
            $this->option_default_value = '';
            $this->option_value_prefix  = array (
                'product-thumb-iconsgroup-position-horizontal ',
                'product-thumb-iconsgroup-position-vertical ',
            );

            $this->render_backend();
        }

        /**
         * Backend Render
         */
        function render_backend() {
            add_filter( 'petszone_woo_custom_product_template_thumb_options', array( $this, 'woo_custom_product_template_thumb_options'), 25, 1 );
        }

        /**
         * Custom Product Templates - Options
         */
        function woo_custom_product_template_thumb_options( $template_options ) {

            array_push( $template_options, $this->setting_args() );

            return $template_options;
        }

        /**
         * Settings Group
         */
        function setting_group() {
            return 'thumb';
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
                ''                                                                              => esc_html__('Default', 'petszone'),

                'product-thumb-iconsgroup-position-horizontal horizontal-position-top'          => esc_html__('Horizontal Top', 'petszone'),
                'product-thumb-iconsgroup-position-horizontal horizontal-position-top-left'     => esc_html__('Horizontal Top Left', 'petszone'),
                'product-thumb-iconsgroup-position-horizontal horizontal-position-top-right'    => esc_html__('Horizontal Top Right', 'petszone'),
                'product-thumb-iconsgroup-position-horizontal horizontal-position-middle'       => esc_html__('Horizontal Middle', 'petszone'),
                'product-thumb-iconsgroup-position-horizontal horizontal-position-bottom'       => esc_html__('Horizontal Bottom', 'petszone'),
                'product-thumb-iconsgroup-position-horizontal horizontal-position-bottom-left'  => esc_html__('Horizontal Bottom Left', 'petszone'),
                'product-thumb-iconsgroup-position-horizontal horizontal-position-bottom-right' => esc_html__('Horizontal Bottom Right', 'petszone'),

                'product-thumb-iconsgroup-position-vertical vertical-position-top-left'         => esc_html__('Vertical Top Left', 'petszone'),
                'product-thumb-iconsgroup-position-vertical vertical-position-top-right'        => esc_html__('Vertical Top Right', 'petszone'),
                'product-thumb-iconsgroup-position-vertical vertical-position-middle-left'      => esc_html__('Vertical Middle Left', 'petszone'),
                'product-thumb-iconsgroup-position-vertical vertical-position-middle-right'     => esc_html__('Vertical Middle Right', 'petszone'),
                'product-thumb-iconsgroup-position-vertical vertical-position-bottom-left'      => esc_html__('Vertical Bottom Left', 'petszone'),
                'product-thumb-iconsgroup-position-vertical vertical-position-bottom-right'     => esc_html__('Vertical Bottom Right', 'petszone')
            );
            $settings['default']    =  $this->option_default_value;

            return $settings;
        }
    }

}

if( !function_exists('petszone_woo_listing_option_thumb_iconsgroup_position') ) {
	function petszone_woo_listing_option_thumb_iconsgroup_position() {
		return PetsZone_Woo_Listing_Option_Thumb_Icon_Group_Position::instance();
	}
}

petszone_woo_listing_option_thumb_iconsgroup_position();