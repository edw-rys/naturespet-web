<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZonePlusSiteBoxedLayout' ) ) {
    class PetsZonePlusSiteBoxedLayout {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
        	$this->backend();
            $this->frontend();
        }

        function backend() {
            add_filter( 'petszone_site_layouts', array( $this, 'add_boxed_layout_option' ) );
            add_filter( 'petszone_plus_customizer_default', array( $this, 'default' ) );
            add_action( 'petszone_site_layout_cutomizer_options', array( $this, 'register_site_layout' ) );
        }

        function frontend() {
            $enable = petszone_customizer_settings( 'customize_boxed_layout' );
            if( isset( $enable ) && ( $enable == true )  ) {
	            add_filter( 'petszone_add_inline_style', array( $this, 'base_style' ) );
	            add_filter( 'body_class', array( $this, 'body_class' ) );
	        }
        }

        function add_boxed_layout_option( $options ) {
            $options['layout-boxed'] = esc_html__('Boxed', 'petszone-plus');
            return $options;
        }

        function default( $option ) {
            $option['customize_boxed_layout']  = false;
            $option['boxed_layout_background'] = array(
                'background-color'      => 'rgb(0,0,0)',
                'background-repeat'     => 'repeat',
                'background-position'   => 'center center',
                'background-size'       => 'cover',
                'background-attachment' => 'inherit'
            );

            return $option;
        }

        function register_site_layout( $wp_customize ) {

                /**
                 * Option : Customize Site Boxed Layout
                 */
                $wp_customize->add_setting(
                    PETSZONE_CUSTOMISER_VAL . '[customize_boxed_layout]', array(
                        'type'    => 'option',
                    )
                );

                $wp_customize->add_control(
                    new PetsZone_Customize_Control_Switch(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[customize_boxed_layout]', array(
                            'type'        => 'wdt-switch',
                            'section'     => 'site-layout-main-section',
                            'label'       => esc_html__( 'Customize Boxed Layout?', 'petszone-plus' ),
                            'description' => esc_html__('YES! to customize boxed layout.', 'petszone-plus'),
                            'dependency'  => array( 'site_layout', '==', 'layout-boxed' ),
                            'choices'     => array(
                                'on'  => esc_attr__( 'Yes', 'petszone-plus' ),
                                'off' => esc_attr__( 'No', 'petszone-plus' )
                            )
                        )
                    )
                );

                /**
                 * Option : Boxed Layout BG
                 */
                $wp_customize->add_setting(
                    PETSZONE_CUSTOMISER_VAL . '[boxed_layout_background]', array(
                        'type'    => 'option',
                    )
                );

                $wp_customize->add_control(
                    new PetsZone_Customize_Control_Background(
                        $wp_customize, PETSZONE_CUSTOMISER_VAL . '[boxed_layout_background]', array(
                            'type'    => 'wdt-background',
                            'section' => 'site-layout-main-section',
                            'label'   => esc_html__( 'Background', 'petszone-plus' ),
                            'dependency' => array( 'site_layout|customize_boxed_layout', '==|==', 'layout-boxed|true' ),
                        )
                    )
                );

        }

        function base_style( $style ) {

            $css    = '';
            $bgoptions = petszone_customizer_settings('boxed_layout_background');

            if( !empty( $bgoptions ) ) {
                $css = !empty( $bgoptions['background-image'] ) ? 'background-image: url("'.esc_url($bgoptions['background-image']).'");':'';
                $css .= !empty( $bgoptions['background-attachment'] ) ? 'background-attachment:'.esc_attr($bgoptions['background-attachment']).';':'';
                $css .= !empty( $bgoptions['background-position'] ) ? 'background-position:'.esc_attr($bgoptions['background-position']).';':'';
                $css .= !empty( $bgoptions['background-size'] ) ? 'background-size:'.esc_attr($bgoptions['background-size']).';':'';
                $css .= !empty( $bgoptions['background-repeat'] ) ? 'background-repeat:'.esc_attr($bgoptions['background-repeat']).';':'';
                $css .= !empty( $bgoptions['background-color'] ) ? 'background-color:'.esc_attr($bgoptions['background-color']).';':'';
            }

            if( !empty( $css ) ) {
                $style .= 'body.layout-boxed {'.petszone_html_output($css).'}'."\n";
            }

            return $style;
        }

        function body_class( $classes ) {

        	$classes[] = 'layout-boxed';
        	return $classes;
        }
    }
}

PetsZonePlusSiteBoxedLayout::instance();