<?php
namespace PetsZoneElementor\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class PetsZone_Shop_Widget_Product_Additional_Tabs_Exploded extends Widget_Base {

	public function get_categories() {
		return [ 'wdt-shop-widgets' ];
	}

	public function get_name() {
		return 'wdt-shop-product-single-additional-tabs-exploded';
	}

	public function get_title() {
		return esc_html__( 'Product Single - Additional Tabs Exploded', 'petszone-pro' );
	}

	public function get_style_depends() {
		return array( 'wdt-shop-product-single-additional-tabs-exploded' );
	}

	public function get_script_depends() {
		return array( 'jquery-nicescroll', 'wdt-shop-product-single-additional-tabs-exploded' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'product_additional_tabs_exploded_section', array(
			'label' => esc_html__( 'General', 'petszone-pro' ),
		) );

			$this->add_control( 'product_id', array(
				'label'       => esc_html__( 'Product Id', 'petszone-pro' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__('Provide product id for which you have to display product summary items. No need to provide ID if it is used in Product single page.', 'petszone-pro'),
			) );

			$this->add_control( 'tab', array(
				'label'       => esc_html__( 'Tab', 'petszone-pro' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__('Choose tab that you would like to use.', 'petszone-pro'),
				'default'     => 'description',
				'options'     => array(
					'custom_tab_1' => esc_html__( 'Custom Tab 1', 'petszone-pro' ),
					'custom_tab_2' => esc_html__( 'Custom Tab 2', 'petszone-pro' ),
					'custom_tab_3' => esc_html__( 'Custom Tab 3', 'petszone-pro' ),
					'custom_tab_4' => esc_html__( 'Custom Tab 4', 'petszone-pro' ),
					'custom_tab_5' => esc_html__( 'Custom Tab 5', 'petszone-pro' )
				),
			) );

			$this->add_control( 'hide_title', array(
				'label'        => esc_html__( 'Hide Title', 'petszone-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'yes', 'petszone-pro' ),
				'label_off'    => esc_html__( 'no', 'petszone-pro' ),
				'default'      => '',
				'return_value' => 'true',
				'description'  => esc_html__( 'If you wish to hide title you can do it here', 'petszone-pro' ),
			) );

			$this->add_control( 'apply_scroll', array(
				'label'        => esc_html__( 'Apply Content Scroll', 'petszone-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'yes', 'petszone-pro' ),
				'label_off'    => esc_html__( 'no', 'petszone-pro' ),
				'default'      => '',
				'return_value' => 'true',
				'description'  => esc_html__( 'If you wish to apply scroll you can do it here', 'petszone-pro' ),
			) );

			$this->add_control( 'scroll_height', array(
				'label'       => esc_html__( 'Scroll Height (px)', 'petszone-pro' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Specify height for your section here.', 'petszone-pro' ),
				'condition'   => array( 'apply_scroll' => 'true' ),
			) );

			$this->add_control(
				'class',
				array (
					'label' => esc_html__( 'Class', 'petszone-pro' ),
					'type'  => Controls_Manager::TEXT
				)
			);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings();

		$output = petszone_shop_product_additional_tabs_exploded_render_html($settings);

		echo $output;

	}

}