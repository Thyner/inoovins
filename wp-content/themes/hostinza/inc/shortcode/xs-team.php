<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Team_Widget extends Widget_Base {

    public function get_name() { 
        return 'xs-team';
    }

    public function get_title() {
        return esc_html__( 'Hostinza Team', 'hostinza' );
    }

    public function get_icon() {
        return 'fa fa-user-o';
    }

    public function get_categories() {
        return [ 'hostinza-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Hostinza Team', 'hostinza'),
            ]
        );

        /**
         *
         * Member Content Feild
         *
        */

        $this->add_control(

            'member_name', 
            [

                'label' =>esc_html__('Team Member', 'hostinza'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('Team Member', 'hostinza'),
                
            ]
        );

        $this->add_control(

            'member_position', 
            [

                'label' =>esc_html__('Position', 'hostinza'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('CEO', 'hostinza'),
                
            ]
        );

        $this->add_control(

            'member_description', 
            [

                'label' =>esc_html__('Description', 'hostinza'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'   =>'',
                
            ]
        );

        

        $this->add_control(
            'image',
            [
                'label' =>esc_html__( 'Thumbnail Image', 'hostinza' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'socials',
            [
                'label' => esc_html__('Social Icon', 'hostinza'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [
                        'icon' => esc_attr('fa fa-facebook'),
                        'url' => esc_url('#'),
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'icon',
                        'label' => esc_html__('Icon CSS Class', 'hostinza'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_attr('fa fa-facebook'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'url',
                        'label' => esc_html__('Social URL', 'hostinza'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_url('#'),
                        'label_block' => true,
                    ],
                ],
                
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'label' =>esc_html__( 'Image Size', 'hostinza' ),
                'default' => 'full',
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_title_style',
            [
                'label'     =>esc_html__( 'Team Style', 'hostinza' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        /**
         *
         * Normal Style
         *
         */

        $this->add_control(
            'member_name_color',
            [
                'label'     =>esc_html__( 'Name color', 'hostinza' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-team .team-bio h4' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'member_pos_color',
            [
                'label'     =>esc_html__( 'Possition color', 'hostinza' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-team .team-bio p' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     =>esc_html__( 'Description color', 'hostinza' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-team .team-hover-content .team-description p' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'social_color',
            [
                'label'     =>esc_html__( 'Social color', 'hostinza' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-team .team-hover-content .simple-social-list li a' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render( ) {

        $settings = $this->get_settings();
        $member_name = $settings['member_name'];
        $member_position = $settings['member_position'];
        $member_description = $settings['member_description'];
        $socials = $settings['socials'];

        ?>

        <div class="xs-single-team wow fadeInUp">
            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings); ?>
            <div class="team-bio">
                <h4><?php echo esc_html( $member_name ); ?></h4>
                <p><?php echo esc_html( $member_position ); ?></p>
            </div>
            <div class="team-hover-content">
                <div class="team-bio">
                    <h4><?php echo esc_html( $member_name ); ?></h4>
                    <p><?php echo esc_html( $member_position ); ?></p>
                </div>
                <?php if($member_description != ''):?>
                    <div class="team-description">
                        <p><?php echo esc_html( $member_description ); ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($socials)): ?>
                    <ul class="simple-social-list list-inline">
                        <?php foreach ($socials as $social): ?>

                        <li><a href="<?php echo esc_url($social['url']);?>"><i class="<?php echo esc_attr($social['icon']);?>"></i></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <?php

    }

    protected function _content_template() { }
}