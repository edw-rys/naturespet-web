<?php
use PetsZoneElementor\Widgets\PetsZoneElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Post_Socials extends PetsZoneElementorWidgetBase {

    public function get_name() {
        return 'wdt-post-socials';
    }

    public function get_title() {
        return esc_html__('Post - Socials', 'petszone-pro');
    }

    protected function register_controls() {

        $this->start_controls_section( 'wdt_section_general', array(
            'label' => esc_html__( 'General', 'petszone-pro'),
        ) );

            $this->add_control( 'style', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__('Style', 'petszone-pro'),
                'default' => '',
                'options' => array(
                    ''  => esc_html__('Default', 'petszone-pro'),
                    'meta-elements-space'		 => esc_html__('Space', 'petszone-pro'),
                    'meta-elements-boxed'  		 => esc_html__('Boxed', 'petszone-pro'),
                    'meta-elements-boxed-curvy'  => esc_html__('Curvy', 'petszone-pro'),
                    'meta-elements-boxed-round'  => esc_html__('Round', 'petszone-pro'),
					'meta-elements-filled'  	 => esc_html__('Filled', 'petszone-pro'),
					'meta-elements-filled-curvy' => esc_html__('Filled Curvy', 'petszone-pro'),
					'meta-elements-filled-round' => esc_html__('Filled Round', 'petszone-pro'),
                ),
            ) );

            $this->add_control( 'el_class', array(
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__('Extra class name', 'petszone-pro'),
                'description' => esc_html__('Style particular element differently - add a class name and refer to it in custom CSS', 'petszone-pro')
            ) );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        extract($settings);

		$out = '';

        global $post;
        $post_id =  $post->ID;

        $template_args['post_ID'] = $post_id;

		$out .= '<div class="entry-social-share-wrapper '.$style.' '.$el_class.'">';
			$out .= petszone_get_template_part( 'post', 'templates/post-extra/social', '', $template_args );
		$out .= '</div>';

		echo $out;
	}

}