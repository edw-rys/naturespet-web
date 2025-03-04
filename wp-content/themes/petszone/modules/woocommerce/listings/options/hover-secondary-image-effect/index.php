<?php
/**
 * Listing Options - Image Effect
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Woo_Listing_Option_Hover_Secondary_Image_Effect' ) ) {

    class PetsZone_Woo_Listing_Option_Hover_Secondary_Image_Effect extends PetsZone_Woo_Listing_Option_Core {

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

            $this->option_slug          = 'product-hover-secondary-image-effect';
            $this->option_name          = esc_html__('Hover Secondary Image Effect', 'petszone');
            $this->option_default_value = 'product-hover-secimage-fade';
            $this->option_type          = array ( 'class', 'value-css' );
            $this->option_value_prefix  = 'product-hover-';

            $this->render_backend();
        }

        /**
         * Backend Render
         */
        function render_backend() {
            add_filter( 'petszone_woo_custom_product_template_hover_options', array( $this, 'woo_custom_product_template_hover_options'), 15, 1 );
        }

        /**
         * Custom Product Templates - Options
         */
        function woo_custom_product_template_hover_options( $template_options ) {

            array_push( $template_options, $this->setting_args() );

            return $template_options;
        }

        /**
         * Settings Group
         */
        function setting_group() {
            return 'hover';
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
                'product-hover-secimage-fade'         => esc_html__('Fade', 'petszone'),
                'product-hover-secimage-zoomin'       => esc_html__('Zoom In', 'petszone'),
                'product-hover-secimage-zoomout'      => esc_html__('Zoom Out', 'petszone'),
                'product-hover-secimage-zoomoutup'    => esc_html__('Zoom Out Up', 'petszone'),
                'product-hover-secimage-zoomoutdown'  => esc_html__('Zoom Out Down', 'petszone'),
                'product-hover-secimage-zoomoutleft'  => esc_html__('Zoom Out Left', 'petszone'),
                'product-hover-secimage-zoomoutright' => esc_html__('Zoom Out Right', 'petszone'),
                'product-hover-secimage-pushup'       => esc_html__('Push Up', 'petszone'),
                'product-hover-secimage-pushdown'     => esc_html__('Push Down', 'petszone'),
                'product-hover-secimage-pushleft'     => esc_html__('Push Left', 'petszone'),
                'product-hover-secimage-pushright'    => esc_html__('Push Right', 'petszone'),
                'product-hover-secimage-slideup'      => esc_html__('Slide Up', 'petszone'),
                'product-hover-secimage-slidedown'    => esc_html__('Slide Down', 'petszone'),
                'product-hover-secimage-slideleft'    => esc_html__('Slide Left', 'petszone'),
                'product-hover-secimage-slideright'   => esc_html__('Slide Right', 'petszone'),
                'product-hover-secimage-hingeup'      => esc_html__('Hinge Up', 'petszone'),
                'product-hover-secimage-hingedown'    => esc_html__('Hinge Down', 'petszone'),
                'product-hover-secimage-hingeleft'    => esc_html__('Hinge Left', 'petszone'),
                'product-hover-secimage-hingeright'   => esc_html__('Hinge Right', 'petszone'),
                'product-hover-secimage-foldup'       => esc_html__('Fold Up', 'petszone'),
                'product-hover-secimage-folddown'     => esc_html__('Fold Down', 'petszone'),
                'product-hover-secimage-foldleft'     => esc_html__('Fold Left', 'petszone'),
                'product-hover-secimage-foldright'    => esc_html__('Fold Right', 'petszone'),
                'product-hover-secimage-fliphoriz'    => esc_html__('Flip Horizontal', 'petszone'),
                'product-hover-secimage-flipvert'     => esc_html__('Flip Vertical', 'petszone')
            );
            $settings['default'] =  $this->option_default_value;

            return $settings;
        }
    }

}

if( !function_exists('petszone_woo_listing_option_hover_secondary_image_effect') ) {
	function petszone_woo_listing_option_hover_secondary_image_effect() {
		return PetsZone_Woo_Listing_Option_Hover_Secondary_Image_Effect::instance();
	}
}

petszone_woo_listing_option_hover_secondary_image_effect();