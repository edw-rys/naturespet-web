<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'PetsZone_Shop_Metabox_Single_Upsell_Related' ) ) {
    class PetsZone_Shop_Metabox_Single_Upsell_Related {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {

			add_filter( 'petszone_shop_product_custom_settings', array( $this, 'petszone_shop_product_custom_settings' ), 10 );

		}

        function petszone_shop_product_custom_settings( $options ) {

			$ct_dependency      = array ();
			$upsell_dependency  = array ( 'show-upsell', '==', 'true');
			$related_dependency = array ( 'show-related', '==', 'true');
			if( function_exists('petszone_shop_single_module_custom_template') ) {
				$ct_dependency['dependency'] 	= array ( 'product-template', '!=', 'custom-template');
				$upsell_dependency 				= array ( 'product-template|show-upsell', '!=|==', 'custom-template|true');
				$related_dependency 			= array ( 'product-template|show-related', '!=|==', 'custom-template|true');
			}

			$product_options = array (

				array_merge (
					array(
						'id'         => 'show-upsell',
						'type'       => 'select',
						'title'      => esc_html__('Show Upsell Products', 'petszone'),
						'class'      => 'chosen',
						'default'    => 'admin-option',
						'attributes' => array( 'data-depend-id' => 'show-upsell' ),
						'options'    => array(
							'admin-option' => esc_html__( 'Admin Option', 'petszone' ),
							'true'         => esc_html__( 'Show', 'petszone'),
							null           => esc_html__( 'Hide', 'petszone'),
						)
					),
					$ct_dependency
				),

				array(
					'id'         => 'upsell-column',
					'type'       => 'select',
					'title'      => esc_html__('Choose Upsell Column', 'petszone'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'petszone' ),
						1              => esc_html__( 'One Column', 'petszone' ),
						2              => esc_html__( 'Two Columns', 'petszone' ),
						3              => esc_html__( 'Three Columns', 'petszone' ),
						4              => esc_html__( 'Four Columns', 'petszone' ),
					),
					'dependency' => $upsell_dependency
				),

				array(
					'id'         => 'upsell-limit',
					'type'       => 'select',
					'title'      => esc_html__('Choose Upsell Limit', 'petszone'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'petszone' ),
						1              => esc_html__( 'One', 'petszone' ),
						2              => esc_html__( 'Two', 'petszone' ),
						3              => esc_html__( 'Three', 'petszone' ),
						4              => esc_html__( 'Four', 'petszone' ),
						5              => esc_html__( 'Five', 'petszone' ),
						6              => esc_html__( 'Six', 'petszone' ),
						7              => esc_html__( 'Seven', 'petszone' ),
						8              => esc_html__( 'Eight', 'petszone' ),
						9              => esc_html__( 'Nine', 'petszone' ),
						10              => esc_html__( 'Ten', 'petszone' ),
					),
					'dependency' => $upsell_dependency
				),

				array_merge (
					array(
						'id'         => 'show-related',
						'type'       => 'select',
						'title'      => esc_html__('Show Related Products', 'petszone'),
						'class'      => 'chosen',
						'default'    => 'admin-option',
						'attributes' => array( 'data-depend-id' => 'show-related' ),
						'options'    => array(
							'admin-option' => esc_html__( 'Admin Option', 'petszone' ),
							'true'         => esc_html__( 'Show', 'petszone'),
							null           => esc_html__( 'Hide', 'petszone'),
						)
					),
					$ct_dependency
				),

				array(
					'id'         => 'related-column',
					'type'       => 'select',
					'title'      => esc_html__('Choose Related Column', 'petszone'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'petszone' ),
						2              => esc_html__( 'Two Columns', 'petszone' ),
						3              => esc_html__( 'Three Columns', 'petszone' ),
						4              => esc_html__( 'Four Columns', 'petszone' ),
					),
					'dependency' => $related_dependency
				),

				array(
					'id'         => 'related-limit',
					'type'       => 'select',
					'title'      => esc_html__('Choose Related Limit', 'petszone'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'petszone' ),
						1              => esc_html__( 'One', 'petszone' ),
						2              => esc_html__( 'Two', 'petszone' ),
						3              => esc_html__( 'Three', 'petszone' ),
						4              => esc_html__( 'Four', 'petszone' ),
						5              => esc_html__( 'Five', 'petszone' ),
						6              => esc_html__( 'Six', 'petszone' ),
						7              => esc_html__( 'Seven', 'petszone' ),
						8              => esc_html__( 'Eight', 'petszone' ),
						9              => esc_html__( 'Nine', 'petszone' ),
						10              => esc_html__( 'Ten', 'petszone' ),
					),
					'dependency' => $related_dependency
				)

			);

			$options = array_merge( $options, $product_options );

			return $options;

		}

    }
}

PetsZone_Shop_Metabox_Single_Upsell_Related::instance();