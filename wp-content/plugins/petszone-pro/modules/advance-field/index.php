<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZoneProAdvanceField' ) ) {
    class PetsZoneProAdvanceField {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            $this->load_widgets();
            add_action( 'petszone_after_main_css', array( $this, 'enqueue_css_assets' ), 20 );
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_js_assets' ) );
        }

        function load_widgets() {
            add_action( 'widgets_init', array( $this, 'register_widgets_init' ) );
        }

        function register_widgets_init() {
            include_once PETSZONE_PRO_DIR_PATH.'modules/advance-field/widget/widget-advance-field.php';
            register_widget('PetsZone_Widget_Advance_Field');
        }
        function enqueue_css_assets() {
            wp_enqueue_style( 'petszone-pro-advance-field', PETSZONE_PRO_DIR_URL . 'modules/advance-field/assets/css/style.css', false, PETSZONE_PRO_VERSION, 'all');

        }

        function enqueue_js_assets() {
            
                wp_enqueue_script( 'petszone-advance-field', PETSZONE_PRO_DIR_URL . 'modules/advance-field/assets/js/script.js', array('jquery'), PETSZONE_PRO_VERSION, true );
           
        }

    }
}

PetsZoneProAdvanceField::instance();