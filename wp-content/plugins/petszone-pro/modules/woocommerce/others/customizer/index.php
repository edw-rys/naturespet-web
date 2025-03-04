<?php

/**
 * Customizer - Others Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Pro_Customizer_Others' ) ) {

    class PetsZone_Pro_Customizer_Others {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            add_filter( 'petszone_shop_pro_customizer_default', array( $this, 'default' ) );
            add_action( 'customize_register', array( $this, 'register' ), 15);

        }

        function default( $option ) {

            $settings = petszone_woo_others()->woo_default_settings();
            extract($settings);

            $option['wdt-woo-addtocart-custom-action'] = $addtocart_custom_action;

            $option['wdt-woo-cross-sell-column'] = $cross_sell_column;
            $option['wdt-woo-cross-sell-title'] = $cross_sell_title;

            if( $cross_sell_style_template == 'predefined' ) {
                $option['wdt-woo-cross-sell-style-template'] = 'predefined-template-'.$cross_sell_style_custom_template;
            } else {
                $option['wdt-woo-cross-sell-style-template'] = $cross_sell_style_custom_template;
            }


            return $option;

        }

        function register( $wp_customize ) {

            /**
             * Others Panel
             */
                $wp_customize->add_section(
                    new PetsZone_Customize_Section(
                        $wp_customize,
                        'woocommerce-others-section',
                        array(
                            'title'    => esc_html__('Others', 'petszone-pro'),
                            'panel'    => 'woocommerce-main-section',
                            'priority' => 50,
                        )
                    )
                );

        }

    }

}


if( !function_exists('petszone_customizer_others') ) {
	function petszone_customizer_others() {
		return PetsZone_Pro_Customizer_Others::instance();
	}
}

petszone_customizer_others();