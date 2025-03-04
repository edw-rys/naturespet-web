<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZonePlusContentAfterHookSettings' ) ) {
    class PetsZonePlusContentAfterHookSettings {
        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            add_filter( 'petszone_plus_customizer_default', array( $this, 'default' ) );
            add_action( 'customize_register', array( $this, 'register' ), 15);

            /**
             * Load Hook After Content in theme.
             */
            add_action( 'petszone_hook_content_after', array( $this, 'hook_content_after' ) );
        }

        function default( $option ) {
            $option['enable_content_after_hook'] = 0;
            $option['content_after_hook']        = '';
            return $option;
        }

        function register( $wp_customize ) {

            $wp_customize->add_section(
                new PetsZone_Customize_Section(
                    $wp_customize,
                    'site-content-after-hook-section',
                    array(
                        'title'    => esc_html__('Content After Hook', 'petszone-plus'),
                        'panel'    => 'site-hook-main-panel',
                        'priority' => 15,
                    )
                )
            );

                /**
                 * Option : Enable Top Hook
                 */
                $wp_customize->add_setting(
                    PETSZONE_CUSTOMISER_VAL . '[enable_content_after_hook]', array(
                        'type'    => 'option',
                    )
                );

                $wp_customize->add_control(
                    new PetsZone_Customize_Control_Switch(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[enable_content_after_hook]', array(
                            'type'        => 'wdt-switch',
                            'section'     => 'site-content-after-hook-section',
                            'label'       => esc_html__( 'Enable Content After Hook', 'petszone-plus' ),
                            'description' => esc_html__('YES! to enable content after hook.', 'petszone-plus'),
                            'choices'     => array(
                                'on'  => esc_attr__( 'Yes', 'petszone-plus' ),
                                'off' => esc_attr__( 'No', 'petszone-plus' )
                            )
                        )
                    )
                );

                /**
                 * Option : Top Hook
                 */
                $wp_customize->add_setting(
                    PETSZONE_CUSTOMISER_VAL . '[content_after_hook]', array(
                        'type'    => 'option',
                        'default' => ''
                    )
                );

                $wp_customize->add_control(
                    new PetsZone_Customize_Control(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[content_after_hook]', array(
                            'type'        => 'textarea',
                            'section'     => 'site-content-after-hook-section',
                            'label'       => esc_html__( 'Content After Hook', 'petszone-plus' ),
                            'dependency'  => array( 'enable_content_after_hook', '!=', '' ),
                            'description' => sprintf( esc_html__('Paste your content after hook, Executes after the closing %s tag.', 'petszone-plus'), '&lt;/#main&gt;' )
                        )
                    )
                );

        }

        function hook_content_after() {
            $enable_hook = petszone_customizer_settings( 'enable_content_after_hook' );
            $hook        = petszone_customizer_settings( 'content_after_hook' );

            if( $enable_hook && !empty( $hook ) ) {
                echo do_shortcode( stripslashes( $hook ) );
            }
        }

    }
}

PetsZonePlusContentAfterHookSettings::instance();