<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZoneProCustomizerSiteHooks' ) ) {
    class PetsZoneProCustomizerSiteHooks {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            $this->load_modules();
        }

        function load_modules() {
            foreach( glob( PETSZONE_PRO_DIR_PATH. 'modules/hooks/customizer/settings/*.php'  ) as $module ) {
                include_once $module;
            }
        }

    }
}

PetsZoneProCustomizerSiteHooks::instance();