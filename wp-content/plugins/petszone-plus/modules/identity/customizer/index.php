<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZonePlusCustomizerSiteIdentity' ) ) {
    class PetsZonePlusCustomizerSiteIdentity {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            add_action( 'customize_register', array( $this, 'register' ), 15 );
        }

        function register( $wp_customize ) {

            /**
             * Panel
             */
            $wp_customize->add_panel(
                new PetsZone_Customize_Panel(
                    $wp_customize,
                    'site-identity-main-panel',
                    array(
                        'title'    => esc_html__('Site Identity', 'petszone-plus'),
                        'priority' => petszone_customizer_panel_priority( 'idenity' )
                    )
                )
            );
        }
    }
}

PetsZonePlusCustomizerSiteIdentity::instance();