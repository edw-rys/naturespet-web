<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZonePlusCustomizerSiteFooter' ) ) {
    class PetsZonePlusCustomizerSiteFooter {

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

            $wp_customize->add_section(
                new PetsZone_Customize_Section(
                    $wp_customize,
                    'site-footer-section',
                    array(
                        'title'    => esc_html__('Footer', 'petszone-plus'),
                        'panel'    => 'site-general-main-panel',
                        'priority' => 20,
                    )
                )
            );

                /**
                 * Option :Site Footer
                 */
                $wp_customize->add_setting(
                    PETSZONE_CUSTOMISER_VAL . '[site_footer]', array(
                        'type'    => 'option',
                    )
                );

                $wp_customize->add_control(
                    new PetsZone_Customize_Control(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[site_footer]', array(
                            'type'    => 'select',
                            'section' => 'site-footer-section',
                            'label'   => esc_html__( 'Site Footer', 'petszone-plus' ),
                            'choices' => apply_filters( 'petszone_footer_layouts', array() ),
                        )
                    )
                );

        }
    }
}

PetsZonePlusCustomizerSiteFooter::instance();