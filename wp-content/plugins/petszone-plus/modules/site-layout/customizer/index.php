<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZonePlusCustomizerSiteLayout' ) ) {
    class PetsZonePlusCustomizerSiteLayout {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {

            add_action( 'customize_register', array( $this, 'register' ), 15 );
            add_filter( 'body_class', array( $this, 'body_class' ) );
        }

        function register( $wp_customize ) {

            /**
             * Site Layout Section
             */
            $wp_customize->add_section(
                new PetsZone_Customize_Section(
                    $wp_customize,
                    'site-layout-main-section',
                    array(
                        'title'    => esc_html__('Site Layout', 'petszone-plus'),
                        'priority' => petszone_customizer_panel_priority( 'layout' )
                    )
                )
            );

                /**
                 * Option :Site Layout
                 */
                $wp_customize->add_setting(
                    PETSZONE_CUSTOMISER_VAL . '[site_layout]', array(
                        'type'    => 'option',
                        'default' => 'wide'
                    )
                );

                $wp_customize->add_control(
                    new PetsZone_Customize_Control(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[site_layout]', array(
                            'type'    => 'select',
                            'section' => 'site-layout-main-section',
                            'label'   => esc_html__( 'Site Layout', 'petszone-plus' ),
                            'choices' => apply_filters( 'petszone_site_layouts', array() ),
                        )
                    )
                );


            do_action('petszone_site_layout_cutomizer_options', $wp_customize );

        }

        function body_class( $classes ) {
            $layout = petszone_customizer_settings('site_layout');

            global $post;
            $id = get_the_ID();
            $settings = get_post_meta( $id, '_petszone_custom_settings', TRUE );
            $settings = is_array( $settings ) ? $settings  : array();

            if( isset($settings['show-fixed-footer']) && !empty($settings['show-fixed-footer']) ) {
                $classes[] = 'wdt-fixed-footer-enabled';
            }

            if( !empty( $layout ) ) {
                $classes[] = $layout;
            }

            return $classes;
        }
    }
}

PetsZonePlusCustomizerSiteLayout::instance();