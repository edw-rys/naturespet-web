<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZonePlusFooter' ) ) {
    class PetsZonePlusFooter {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            $this->load_footer_layouts();
            $this->load_modules();
        }

        function load_footer_layouts() {
            foreach( glob( PETSZONE_PLUS_DIR_PATH. 'modules/footer/layouts/*/index.php'  ) as $module ) {
                include_once $module;
            }
        }

        function load_modules() {
            include_once PETSZONE_PLUS_DIR_PATH.'modules/footer/customizer/index.php';
            include_once PETSZONE_PLUS_DIR_PATH.'modules/footer/elementor/index.php';
        }
    }
}

PetsZonePlusFooter::instance();