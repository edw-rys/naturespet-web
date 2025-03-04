<?php

/*
* Update Summary - Options Filter
*/

if( ! function_exists( 'petszone_shop_woo_single_summary_options_cpetszone_render' ) ) {
	function petszone_shop_woo_single_summary_options_cpetszone_render( $options ) {

		$options['countdown'] = esc_html__('Summary Count Down', 'petszone-pro');
		return $options;

	}
	add_filter( 'petszone_shop_woo_single_summary_options', 'petszone_shop_woo_single_summary_options_cpetszone_render', 10, 1 );

}

/*
* Update Summary - Styles Filter
*/

if( ! function_exists( 'petszone_shop_woo_single_summary_styles_cpetszone_render' ) ) {
	function petszone_shop_woo_single_summary_styles_cpetszone_render( $styles ) {

		array_push( $styles, 'wdt-shop-coundown-timer' );
		return $styles;

	}
	add_filter( 'petszone_shop_woo_single_summary_styles', 'petszone_shop_woo_single_summary_styles_cpetszone_render', 10, 1 );

}

/*
* Update Summary - Scripts Filter
*/

if( ! function_exists( 'petszone_shop_woo_single_summary_scripts_cpetszone_render' ) ) {
	function petszone_shop_woo_single_summary_scripts_cpetszone_render( $scripts ) {

		array_push( $scripts, 'jquery-downcount' );
		array_push( $scripts, 'wdt-shop-coundown-timer' );
		return $scripts;

	}
	add_filter( 'petszone_shop_woo_single_summary_scripts', 'petszone_shop_woo_single_summary_scripts_cpetszone_render', 10, 1 );

}