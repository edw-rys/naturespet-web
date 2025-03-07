<?php
use PetsZoneElementor\Widgets\PetsZoneElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Elementor_Post_Meta_Group extends PetsZoneElementorWidgetBase {

    public function get_name() {
        return 'wdt-post-meta-group';
    }

    public function get_title() {
        return esc_html__('Post - Meta Group', 'petszone-pro');
    }

    protected function register_controls() {

        $this->start_controls_section( 'wdt_section_general', array(
            'label' => esc_html__( 'General', 'petszone-pro'),
        ) );

            $content = new Repeater();
            $content->add_control( 'element_value', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__('Element', 'petszone-pro'),
                'default' => 'author',
                'options' => array(
                    'author'      => esc_html__('Author', 'petszone-pro'),
                    'date'        => esc_html__('Date', 'petszone-pro'),
                    'comment'     => esc_html__('Comments', 'petszone-pro'),
                    'category'    => esc_html__('Categories', 'petszone-pro'),
                    'tag'         => esc_html__('Tags', 'petszone-pro'),
                    'social'      => esc_html__('Social Share', 'petszone-pro'),
                    'likes_views' => esc_html__('Likes & Views', 'petszone-pro'),
                ),
            ) );

            $this->add_control( 'blog_meta_position', array(
                'type'        => Controls_Manager::REPEATER,
                'label'       => esc_html__('Meta Group Positioning', 'petszone-pro'),
                'fields'      => array_values( $content->get_controls() ),
                'default'     => array(
                    array( 'element_value' => 'author' ),
                ),
                'title_field' => '{{{ element_value.replace( \'_\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}'
            ) );

            $this->add_control( 'style', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__('Style', 'petszone-pro'),
                'default' => 'metagroup-space-separator',
                'options' => array(
                    'metagroup-space-separator'  => esc_html__('Space', 'petszone-pro'),
                    'metagroup-slash-separator'  => esc_html__('Slash', 'petszone-pro'),
                    'metagroup-vertical-separator'  => esc_html__('Vertical', 'petszone-pro'),
                    'metagroup-horizontal-separator'  => esc_html__('Horizontal', 'petszone-pro'),
                    'metagroup-dot-separator'  => esc_html__('Dot', 'petszone-pro'),
                    'metagroup-comma-separator'  => esc_html__('Comma', 'petszone-pro'),
                    'metagroup-elements-boxed'  => esc_html__('Boxed', 'petszone-pro'),
                    'metagroup-elements-boxed-curvy'  => esc_html__('Boxed Curvy', 'petszone-pro'),
                    'metagroup-elements-boxed-round'  => esc_html__('Boxed Round', 'petszone-pro'),
                    'metagroup-elements-filled'  => esc_html__('Filled', 'petszone-pro'),
                    'metagroup-elements-filled-curvy'  => esc_html__('Filled Curvy', 'petszone-pro'),
                    'metagroup-elements-filled-round'  => esc_html__('Filled Round', 'petszone-pro'),
                ),
                'description' => esc_html__('Select any one of meta group styling.', 'petszone-pro'),
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

		$newMEles = array();
		$meta_group_position = !empty( $blog_meta_position ) ? $blog_meta_position : explode( ',', $blog_meta_position );

		if( is_array( $meta_group_position[0] ) ) {
			foreach($meta_group_position as $key => $items) {
				$newMEles[$items['element_value']] = $items['element_value'];
			}
		} else {
			foreach($meta_group_position as $item) {
				$newMEles[$item] = $item;
			}
		}

		if( count( $newMEles ) >= 1 ) {

			$out .= '<div class="wdt-posts-meta-group '.$style.' '.$el_class.'">';

                $Post_Style = petszone_get_single_post_style( $post_id );

                $template_args['post_ID'] = $post_id;
                $template_args['post_Style'] = $Post_Style;
                $template_args = array_merge( $template_args, petszone_single_post_params() );

				foreach( $newMEles as $value ):

                    switch( $value ):

                        case 'likes_views':
                        case 'social':
                            $out .= petszone_get_template_part( 'post', 'templates/post-extra/'.$value, '', $template_args );
                            break;

                        default:
                            $out .= petszone_get_template_part( 'post', 'templates/'.$Post_Style.'/parts/'.$value, '', $template_args );
                            break;

                    endswitch;

				endforeach;

			$out .= '</div>';
		}

		echo $out;
    }

}