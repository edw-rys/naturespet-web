<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Option_backup extends CSFramework_Options {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output() {

    echo apply_filters( 'cs_element_before', $this->element_before() );

    echo '<textarea name="'. esc_attr($this->unique) .'[import]"'. petszone_html_output($this->element_class()) . petszone_html_output($this->element_attributes()) .'></textarea>';
    submit_button( esc_html__( 'Import a Backup', 'petszone-pro' ), 'primary cs-import-backup', 'backup', false );
    echo '<small>( '. esc_html__( 'copy-paste your backup string here', 'petszone-pro' ).' )</small>';

    echo '<hr />';

    echo '<textarea name="_nonce"'. petszone_html_output($this->element_class()) . petszone_html_output($this->element_attributes()) .' disabled="disabled">'. cs_encode_string( get_option( $this->unique ) ) .'</textarea>';
    echo '<a href="'. esc_url( admin_url( 'admin-ajax.php?action=cs-export-options' ) ) .'" class="button button-primary" target="_blank">'. esc_html__( 'Export and Download Backup', 'petszone-pro' ) .'</a>';
    echo '<small>-( '. esc_html__( 'or', 'petszone-pro' ) .' )-</small>';
    submit_button( esc_html__( 'Reset All Options', 'petszone-pro' ), 'cs-warning-primary cs-reset-confirm', $this->unique . '[resetall]', false );
    echo '<small class="cs-text-warning">'. esc_html__( 'Please be sure for reset all of framework options.', 'petszone-pro' ) .'</small>';

    echo apply_filters( 'cs_element_after', $this->element_after() );
  }

}
