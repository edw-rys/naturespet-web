<?php

/**
 * WooCommerce - Single - Module - Additional Tabs
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Shop_Single_Module_Additional_Tabs' ) ) {

    class PetsZone_Shop_Single_Module_Additional_Tabs {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            // Load Modules
                $this->load_modules();

            // CSS
                add_filter( 'petszone_woo_css', array( $this, 'woo_css'), 10, 1 );

            // JS
                add_filter( 'petszone_woo_js', array( $this, 'woo_js'), 10, 1 );

        }

        /*
        Module Paths
        */

            function module_dir_path() {

                if( petszone_is_file_in_theme( __FILE__ ) ) {
                    return PETSZONE_MODULE_DIR . '/woocommerce/single/modules/additional-tabs/';
                } else {
                    return trailingslashit( plugin_dir_path( __FILE__ ) );
                }

            }

            function module_dir_url() {

                if( petszone_is_file_in_theme( __FILE__ ) ) {
                    return PETSZONE_MODULE_URI . '/woocommerce/single/modules/additional-tabs/';
                } else {
                    return trailingslashit( plugin_dir_url( __FILE__ ) );
                }

            }

        /*
        Load Modules
        */

            function load_modules() {

                // If Theme-Plugin is activated

                    if( function_exists( 'petszone_pro' ) ) {

                        // Metabox
                            include_once $this->module_dir_path() . 'metabox/index.php';

                        // Elementor
                            include_once $this->module_dir_path() . 'elementor/index.php';

                    }

                // Includes
                    include_once $this->module_dir_path() . 'includes/index.php';

            }


        /*
        CSS
        */
            function woo_css( $css ) {

                $product_template = petszone_shop_woo_product_single_template_option();

                if( $product_template == 'custom-template' ) {

                    $css_file_path = $this->module_dir_path() . 'assets/css/style.css';

                    if( file_exists ( $css_file_path ) ) {

                        ob_start();
                        include( $css_file_path );
                        $css .= "\n\n".ob_get_clean();

                    }

                }

                return $css;

            }

        /*
        JS
        */
            function woo_js( $js ) {

                $product_template = petszone_shop_woo_product_single_template_option();

                if( $product_template == 'custom-template' ) {

                    wp_enqueue_script('jquery-nicescroll', $this->module_dir_url() . 'assets/js/jquery.nicescroll.js', array('jquery'), false, true);

                    $js_file_path = $this->module_dir_path() . 'assets/js/scripts.js';

                    if( file_exists ( $js_file_path ) ) {

                        ob_start();
                        include( $js_file_path );
                        $js .= "\n\n".ob_get_clean();

                    }

                }

                return $js;

            }

    }

}

if( !function_exists('petszone_shop_single_module_additional_tabs') ) {
	function petszone_shop_single_module_additional_tabs() {
        $reflection = new ReflectionClass('PetsZone_Shop_Single_Module_Additional_Tabs');
        return $reflection->newInstanceWithoutConstructor();
	}
}

PetsZone_Shop_Single_Module_Additional_Tabs::instance();