<?php
use PetsZoneElementor\Widgets\PetsZoneElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Lightbox extends PetsZoneElementorWidgetBase {

    public function get_name() {
        return 'wdt-lightbox';
    }

    public function get_title() {
        return esc_html__('Lightbox Image', 'petszone-pro');
    }

    protected function register_controls() {

        $this->start_controls_section( 'wdt_section_general', array(
            'label' => esc_html__( 'General', 'petszone-pro'),
        ) );

            $this->add_control( 'url', array(
                'type'        => Controls_Manager::MEDIA,
                'label'       => esc_html__('Choose Image', 'petszone-pro'),
				'default'	  => array( 'url' => \Elementor\Utils::get_placeholder_image_src(), ),
                'description' => esc_html__( 'Choose any one image from media.', 'petszone-pro' ),
            ) );

            $this->add_control( 'title', array(
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__('Title', 'petszone-pro'),
                'default'     => '',
				'description' => esc_html__('Put the image title on preview.', 'petszone-pro'),
            ) );

            $this->add_control( 'align', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__('Alignment', 'petszone-pro'),
                'default' => 'alignnone',
                'options' => array(
                    'alignnone'   => esc_html__('None', 'petszone-pro'),
                    'alignleft'	  => esc_html__('Left', 'petszone-pro'),
                    'aligncenter' => esc_html__('Center', 'petszone-pro'),
                    'alignright'  => esc_html__('Right', 'petszone-pro'),
                ),
            ) );

            $this->add_control( 'class', array(
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__('Extra class name', 'petszone-pro'),
                'description' => esc_html__('Style particular element differently - add a class name and refer to it in custom CSS', 'petszone-pro')
            ) );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        extract($settings);

        $image = wp_get_attachment_image( $url['id'], 'full' );
        $lurl = wp_get_attachment_image_url( $url['id'], 'full' );
        $url = $image;

		if( !empty( $url ) ):
			if( !empty($class) ):
				$url = str_replace(' class="', ' class="'.$class.' ', $url);
			endif;

			if( !empty($align) ):
				$url = str_replace(' class="', ' class="'.$align.' ', $url);
			endif;

            #if( get_option('elementor_global_image_lightbox') ) :
                echo '<a href="'.$lurl.'" title="'.$title.'">'.$url.'</a>';
            #else:
            #    echo '<a href="'.$lurl.'" title="'.$title.'" class="lightbox-preview-img">'.$url.'</a>';
            #endif;
		endif;
	}

}