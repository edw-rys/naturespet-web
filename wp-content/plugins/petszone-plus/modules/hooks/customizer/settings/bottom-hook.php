<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZonePlusBottomHookSettings' ) ) {
    class PetsZonePlusBottomHookSettings {
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
             * Load Bottom Hook Content in theme.
             */
            add_action( 'petszone_hook_bottom', array( $this, 'bottom_top_content' ) );
        }

        function default( $option ) {
            $option['enable_bottom_hook'] = 0;
            $option['bottom_hook']        = '';

            return $option;
        }

        function register( $wp_customize ) {

            $wp_customize->add_section(
                new PetsZone_Customize_Section(
                    $wp_customize,
                    'site-bottom-hook-section',
                    array(
                        'title'    => esc_html__('Bottom Hook', 'petszone-plus'),
                        'panel'    => 'site-hook-main-panel',
                        'priority' => 20,
                    )
                )
            );

                /**
                 * Option : Enable Bottom Hook
                 */
                $wp_customize->add_setting(
                    PETSZONE_CUSTOMISER_VAL . '[enable_bottom_hook]', array(
                        'type'    => 'option',
                        'default' => '',
                    )
                );

                $wp_customize->add_control(
                    new PetsZone_Customize_Control_Switch(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[enable_bottom_hook]', array(
                            'type'        => 'wdt-switch',
                            'section'     => 'site-bottom-hook-section',
                            'label'       => esc_html__( 'Enable Bottom Hook', 'petszone-plus' ),
                            'description' => esc_html__('YES! to enable bottom hook.', 'petszone-plus'),
                            'choices'     => array(
                                'on'  => esc_attr__( 'Yes', 'petszone-plus' ),
                                'off' => esc_attr__( 'No', 'petszone-plus' )
                            )
                        )
                    )
                );

                /**
                 * Option : Bottom Hook
                 */
                $wp_customize->add_setting(
                    PETSZONE_CUSTOMISER_VAL . '[bottom_hook]', array(
                        'type'    => 'option',
                    )
                );

                $wp_customize->add_control(
                    new PetsZone_Customize_Control(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[bottom_hook]', array(
                            'type'        => 'textarea',
                            'section'     => 'site-bottom-hook-section',
                            'label'       => esc_html__( 'Bottom Hook', 'petszone-plus' ),
                            'dependency'  => array( 'enable_bottom_hook', '!=', '' ),
                            'description' => esc_html__('Paste your bottom hook, Executes after the closing &lt;/body&gt; tag.', 'petszone-plus'),
                        )
                    )
                );

        }

        function bottom_top_content() {
            $enable_bottom_hook = petszone_customizer_settings( 'enable_bottom_hook' );
            $bottom_hook        = petszone_customizer_settings( 'bottom_hook' );

            if( $enable_bottom_hook && !empty( $bottom_hook ) ) {
                echo do_shortcode( stripslashes( $bottom_hook ) );
            }
        }
    }
}

PetsZonePlusBottomHookSettings::instance();