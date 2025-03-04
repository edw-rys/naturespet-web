<?php

namespace PetsZoneElementor\Widgets;
use PetsZoneElementor\Widgets\PetsZone_Shop_Widget_Product_Summary;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class PetsZone_Shop_Widget_Product_Summary_Extend extends PetsZone_Shop_Widget_Product_Summary {

	function dynamic_register_controls() {

		$this->start_controls_section( 'product_summary_extend_section', array(
			'label' => esc_html__( 'Social Options', 'petszone-pro' ),
		) );

			$this->add_control( 'share_follow_type', array(
				'label'   => esc_html__( 'Share / Follow Type', 'petszone-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'share',
				'options' => array(
					''       => esc_html__('None', 'petszone-pro'),
					'share'  => esc_html__('Share', 'petszone-pro'),
					'follow' => esc_html__('Follow', 'petszone-pro'),
				),
				'description' => esc_html__( 'Choose between Share / Follow you would like to use.', 'petszone-pro' ),
			) );

			$this->add_control( 'social_icon_style', array(
				'label'   => esc_html__( 'Social Icon Style', 'petszone-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					'simple'        => esc_html__( 'Simple', 'petszone-pro' ),
					'bgfill'        => esc_html__( 'BG Fill', 'petszone-pro' ),
					'brdrfill'      => esc_html__( 'Border Fill', 'petszone-pro' ),
					'skin-bgfill'   => esc_html__( 'Skin BG Fill', 'petszone-pro' ),
					'skin-brdrfill' => esc_html__( 'Skin Border Fill', 'petszone-pro' ),
				),
				'description' => esc_html__( 'This option is applicable for all buttons used in product summary.', 'petszone-pro' ),
				'condition'   => array( 'share_follow_type' => array ('share', 'follow') )
			) );

			$this->add_control( 'social_icon_radius', array(
				'label'   => esc_html__( 'Social Icon Radius', 'petszone-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					'square'  => esc_html__( 'Square', 'petszone-pro' ),
					'rounded' => esc_html__( 'Rounded', 'petszone-pro' ),
					'circle'  => esc_html__( 'Circle', 'petszone-pro' ),
				),
				'condition'   => array(
					'social_icon_style' => array ('bgfill', 'brdrfill', 'skin-bgfill', 'skin-brdrfill'),
					'share_follow_type' => array ('share', 'follow')
				),
			) );

			$this->add_control( 'social_icon_inline_alignment', array(
				'label'        => esc_html__( 'Social Icon Inline Alignment', 'petszone-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'yes', 'petszone-pro' ),
				'label_off'    => esc_html__( 'no', 'petszone-pro' ),
				'default'      => '',
				'return_value' => 'true',
				'description'  => esc_html__( 'This option is applicable for all buttons used in product summary.', 'petszone-pro' ),
				'condition'   => array( 'share_follow_type' => array ('share', 'follow') )
			) );

		$this->end_controls_section();

	}

}