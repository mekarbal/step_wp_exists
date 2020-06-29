<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Htslider_Elementor_Widget_Sliders extends Widget_Base {

    public function get_name() {
        return 'htslider-slider-addons';
    }
    
    public function get_title() {
        return __( 'HT: Slider', 'ht-slider' );
    }

    public function get_icon() {
        return 'eicon-slideshow';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_style_depends() {
        return [ 'slick' ];
    }

    public function get_script_depends() {
        return [
            'htslider-active',
            'slick',
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'ht-slider-slider-conent',
            [
                'label' => __( 'Slider', 'ht-slider' ),
            ]
        );
        
            $this->add_control(
                'slider_show_by',
                [
                    'label' => esc_html__( 'Slider Show By', 'ht-slider' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'show_bycat',
                    'options' => [
                        'show_byid'   => __( 'Show By ID', 'ht-slider' ),
                        'show_bycat'  => __( 'Show By Category', 'ht-slider' ),
                    ],
                ]
            );

            $this->add_control(
                'slider_id',
                [
                    'label' => __( 'Select Slider', 'ht-slider' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => htslider_post_name( 'htslider_slider' ),
                    'condition' => [
                        'slider_show_by' => 'show_byid',
                    ]
                ]
            );

            $this->add_control(
                'slider_cat',
                [
                    'label' => __( 'Select Category', 'ht-slider' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => htslider_get_taxonomies( 'htslider_category' ),
                    'condition' => [
                        'slider_show_by' => 'show_bycat',
                    ]
                ]
            );
            
            $this->add_control(
                'slider_limit',
                [
                    'label' => __( 'Slider Limit', 'ht-slider' ),
                    'type' => Controls_Manager::NUMBER,
                    'step' => 1,
                    'default' => 2,
                ]
            );

        $this->end_controls_section();

        // Slider setting
        $this->start_controls_section(
            'ht-slider-slider',
            [
                'label' => esc_html__( 'Slider Option', 'ht-slider' ),
            ]
        );

            $this->add_control(
                'slprevicon',
                [
                    'label'         => esc_html__( 'Previous icon', 'ht-slider' ),
                    'type'          => Controls_Manager::ICONS,
                    'default'       => [
                        'value'     => 'fas fa-angle-left',
                        'library'   => 'solid',
                    ],
                ]
            );

            $this->add_control(
                'slnexticon',
                [
                    'label'         => esc_html__( 'Next icon', 'ht-slider' ),
                    'type'          => Controls_Manager::ICONS,
                    'default'       => [
                        'value'     => 'fas fa-angle-right',
                        'library'   => 'solid',
                    ]
                ]
            );

            $this->add_control(
                'slitems',
                [
                    'label' => esc_html__( 'Slider Items', 'ht-slider' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                    'default' => 1
                ]
            );

            $this->add_control(
                'slarrows',
                [
                    'label' => esc_html__( 'Slider Arrow', 'ht-slider' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'sldots',
                [
                    'label' => esc_html__( 'Slider dots', 'ht-slider' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no'
                ]
            );

            $this->add_control(
                'slpause_on_hover',
                [
                    'type' => Controls_Manager::SWITCHER,
                    'label_off' => __('No', 'ht-slider'),
                    'label_on' => __('Yes', 'ht-slider'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'label' => __('Pause on Hover?', 'ht-slider'),
                ]
            );

            $this->add_control(
                'slautolay',
                [
                    'label' => esc_html__( 'Slider auto play', 'ht-slider' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator' => 'before',
                    'default' => 'no'
                ]
            );

            $this->add_control(
                'slautoplay_speed',
                [
                    'label' => __('Autoplay speed', 'ht-slider'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 3000,
                    'condition' => [
                        'slautolay' => 'yes',
                    ]
                ]
            );


            $this->add_control(
                'slanimation_speed',
                [
                    'label' => __('Autoplay animation speed', 'ht-slider'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 300,
                    'condition' => [
                        'slautolay' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slscroll_columns',
                [
                    'label' => __('Slider item to scroll', 'ht-slider'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                    'default' => 1,
                ]
            );

            $this->add_control(
                'heading_tablet',
                [
                    'label' => __( 'Tablet', 'ht-slider' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
            );

            $this->add_control(
                'sltablet_display_columns',
                [
                    'label' => __('Slider Items', 'ht-slider'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 8,
                    'step' => 1,
                    'default' => 1,
                ]
            );

            $this->add_control(
                'sltablet_scroll_columns',
                [
                    'label' => __('Slider item to scroll', 'ht-slider'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 8,
                    'step' => 1,
                    'default' => 1,
                ]
            );

            $this->add_control(
                'sltablet_width',
                [
                    'label' => __('Tablet Resolution', 'ht-slider'),
                    'description' => __('The resolution to tablet.', 'ht-slider'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 750,
                ]
            );

            $this->add_control(
                'heading_mobile',
                [
                    'label' => __( 'Mobile Phone', 'ht-slider' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
            );

            $this->add_control(
                'slmobile_display_columns',
                [
                    'label' => __('Slider Items', 'ht-slider'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                    'default' => 1,
                ]
            );

            $this->add_control(
                'slmobile_scroll_columns',
                [
                    'label' => __('Slider item to scroll', 'ht-slider'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                    'default' => 1,
                ]
            );

            $this->add_control(
                'slmobile_width',
                [
                    'label' => __('Mobile Resolution', 'ht-slider'),
                    'description' => __('The resolution to mobile.', 'ht-slider'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 480,
                ]
            );

        $this->end_controls_section(); // Slider Option end

        // Slider Button stle
        $this->start_controls_section(
            'ht-slider-slider-controller-style',
            [
                'label' => esc_html__( 'Slider Controller Style', 'ht-slider' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'slider_navigation_style',
                [
                    'label' => esc_html__( 'Slider Navigation Style', 'ht-slider' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1'  => __( 'Style One', 'ht-slider' ),
                        '2'  => __( 'Style Two', 'ht-slider' ),
                        '3'  => __( 'Style Three', 'ht-slider' ),
                    ],
                ]
            );

            $this->start_controls_tabs('ht-slider_sliderbtn_style_tabs');

                // Slider Button style Normal
                $this->start_controls_tab(
                    'ht-slider_sliderbtn_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'ht-slider' ),
                    ]
                );

                    $this->add_control(
                        'button_style_heading',
                        [
                            'label' => __( 'Navigation Arrow', 'ht-slider' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $this->add_control(
                        'nav_size',
                        [
                            'label' => __( 'Navigation Arrow Size', 'ht-slider' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
                                ]
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 22,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htslider-slider button i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_color',
                        [
                            'label' => __( 'Color', 'ht-slider' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#1f2226',
                            'selectors' => [
                                '{{WRAPPER}} .htslider-slider .slick-arrow' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htslider-slider .slick-arrow i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .hero-slider-controls .slick-arrow i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-arrow' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_bg_color',
                        [
                            'label' => __( 'Background Color', 'ht-slider' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .htslider-slider .slick-arrow' => 'background-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-arrow' => 'background-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => __( 'Border', 'ht-slider' ),
                            'selector' => '{{WRAPPER}} .htslider-slider .slick-arrow,{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-arrow',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'ht-slider' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-slider .slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => __( 'Padding', 'ht-slider' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htslider-slider .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                '{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_style_dots_heading',
                        [
                            'label' => __( 'Navigation Dots', 'ht-slider' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                        $this->add_control(
                            'dots_bg_color',
                            [
                                'label' => __( 'Background Color', 'ht-slider' ),
                                'type' => Controls_Manager::COLOR,
                                'scheme' => [
                                    'type' => Scheme_Color::get_type(),
                                    'value' => Scheme_Color::COLOR_1,
                                ],
                                'default' =>'#ffffff',
                                'selectors' => [
                                    '{{WRAPPER}} .htslider-slider .slick-dots li button' => 'background-color: {{VALUE}} !important;',
                                    '{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-dots li button' => 'background-color: {{VALUE}} !important;',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            Group_Control_Border::get_type(),
                            [
                                'name' => 'dots_border',
                                'label' => __( 'Border', 'ht-slider' ),
                                'selector' => '{{WRAPPER}} .htslider-slider .slick-dots li button,{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-dots li button',
                            ]
                        );

                        $this->add_responsive_control(
                            'dots_border_radius',
                            [
                                'label' => esc_html__( 'Border Radius', 'ht-slider' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .htslider-slider .slick-dots li button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                    '{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-dots li button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                ],
                            ]
                        );

                $this->end_controls_tab();// Normal button style end

                // Button style Hover
                $this->start_controls_tab(
                    'ht-slider_sliderbtn_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'ht-slider' ),
                    ]
                );

                    $this->add_control(
                        'button_style_arrow_heading',
                        [
                            'label' => __( 'Navigation', 'ht-slider' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $this->add_control(
                        'button_hover_color',
                        [
                            'label' => __( 'Color', 'ht-slider' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#23252a',
                            'selectors' => [
                                '{{WRAPPER}} .htslider-slider .slick-arrow:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htslider-slider .slick-arrow:hover i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .hero-slider-controls .slick-arrow:hover i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-arrow:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_hover_bg_color',
                        [
                            'label' => __( 'Background', 'ht-slider' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' =>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .htslider-slider .slick-arrow:hover' => 'background-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-arrow:hover' => 'background-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => __( 'Border', 'ht-slider' ),
                            'selector' => '{{WRAPPER}} .htslider-slider .slick-arrow:hover,{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-arrow:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'ht-slider' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-slider .slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );


                    $this->add_control(
                        'button_style_dotshov_heading',
                        [
                            'label' => __( 'Navigation Dots', 'ht-slider' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                        $this->add_control(
                            'dots_hover_bg_color',
                            [
                                'label' => __( 'Background Color', 'ht-slider' ),
                                'type' => Controls_Manager::COLOR,
                                'scheme' => [
                                    'type' => Scheme_Color::get_type(),
                                    'value' => Scheme_Color::COLOR_1,
                                ],
                                'default' =>'#282828',
                                'selectors' => [
                                    '{{WRAPPER}} .htslider-slider .slick-dots li button:hover' => 'background-color: {{VALUE}} !important;',
                                    '{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-dots li button:hover' => 'background-color: {{VALUE}} !important;',
                                    '{{WRAPPER}} .htslider-slider .slick-dots li.slick-active button' => 'background-color: {{VALUE}} !important;',
                                    '{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-dots li.slick-active button' => 'background-color: {{VALUE}} !important;',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            Group_Control_Border::get_type(),
                            [
                                'name' => 'dots_border_hover',
                                'label' => __( 'Border', 'ht-slider' ),
                                'selector' => '{{WRAPPER}} .htslider-slider .slick-dots li button:hover,{{WRAPPER}}.htslider-slider-area .hero-slider-controls .slick-dots li button:hover',
                            ]
                        );

                        $this->add_responsive_control(
                            'dots_border_radius_hover',
                            [
                                'label' => esc_html__( 'Border Radius', 'ht-slider' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .htslider-slider .slick-dots li button:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                    '{{WRAPPER}} .htslider-slider-area .hero-slider-controls .slick-dots li button:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                ],
                            ]
                        );

                $this->end_controls_tab();// Hover button style end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Tab option end

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $id = $this->get_id();
        $args = array(
            'post_type'             => 'htslider_slider',
            'posts_per_page'        => $settings['slider_limit'],
            'post_status'           => 'publish',
            'order'                 => 'ASC',
        );

        // Fetch By id
        if( $settings['slider_show_by'] == 'show_byid' ){
            $args['post__in'] = $settings['slider_id'];
        }

        // Fetch by category
        if( $settings['slider_show_by'] == 'show_bycat' ){
            // By Category
            $get_slider_categories = $settings['slider_cat'];
            $slider_cats = str_replace(' ', '', $get_slider_categories);
            if ( "0" != $get_slider_categories) {
                if( is_array( $slider_cats ) && count( $slider_cats ) > 0 ){
                    $field_name = is_numeric( $slider_cats[0] )?'term_id':'slug';
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'htslider_category',
                            'terms' => $slider_cats,
                            'field' => $field_name,
                            'include_children' => false
                        )
                    );
                }
            }
        }
        $sliders = new \WP_Query( $args );

        // Slider Options
        $slider_settings = [
            'arrows' => ('yes' === $settings['slarrows']),
            'arrow_prev_txt' => HTSliders_Icons_managers::render_icon( $settings['slprevicon'], [ 'aria-hidden' => 'true' ] ),
            'arrow_next_txt' => HTSliders_Icons_managers::render_icon( $settings['slnexticon'], [ 'aria-hidden' => 'true' ] ),
            'dots' => ('yes' === $settings['sldots']),
            'autoplay' => ('yes' === $settings['slautolay']),
            'autoplay_speed' => absint($settings['slautoplay_speed']),
            'animation_speed' => absint($settings['slanimation_speed']),
            'pause_on_hover' => ('yes' === $settings['slpause_on_hover']),
        ];

        $slider_responsive_settings = [
            'product_items' => $settings['slitems'],
            'scroll_columns' => $settings['slscroll_columns'],
            'tablet_width' => $settings['sltablet_width'],
            'tablet_display_columns' => $settings['sltablet_display_columns'],
            'tablet_scroll_columns' => $settings['sltablet_scroll_columns'],
            'mobile_width' => $settings['slmobile_width'],
            'mobile_display_columns' => $settings['slmobile_display_columns'],
            'mobile_scroll_columns' => $settings['slmobile_scroll_columns'],
        ];
        $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );

        $sliderpost_ids = array();
        while( $sliders->have_posts() ):$sliders->the_post();
            $sliderpost_ids[] = get_the_ID();
        endwhile;
        wp_reset_postdata(); wp_reset_query();

        // Slider Area attribute
        $this->add_render_attribute( 'slider_area_attr', 'class', 'htslider-slider-area' );
        $this->add_render_attribute( 'slider_area_attr', 'class', 'navigation-style-'.$settings['slider_navigation_style'] );

        // Slider attribute
        $this->add_render_attribute( 'slider_attr', 'class', 'slider-area htslider-slider' );
        $this->add_render_attribute( 'slider_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        
        // Append Navigation HTML
        $slider_append = array();
        if( $settings['slider_navigation_style'] != 1 ){
            $slider_append = [
                'appendArrows' =>'.htslider-controls-area-'.$id,
                'appendDots' =>'.htslider-controls-area-'.$id,
            ];
            $this->add_render_attribute( 'slider_attr', 'data-slick', wp_json_encode( $slider_append ) );
        }

        ?>
            <div <?php echo $this->get_render_attribute_string( 'slider_area_attr' ); ?> >
                <div <?php echo $this->get_render_attribute_string( 'slider_attr' ); ?> >
                    <?php foreach( $sliderpost_ids as $slider_item ): ?>
                        <div class="slingle-slider">
                            <?php
                                if ( ! Plugin::instance()->db->is_built_with_elementor( $slider_item ) ) {
                                    echo apply_filters( 'the_content', get_post_field( 'post_content', $slider_item ) );
                                }else{
                                    echo Plugin::instance()->frontend->get_builder_content_for_display( $slider_item );
                                }                
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if( $settings['slider_navigation_style'] != 1 ){ echo '<div class="hero-slider-controls htslider-controls-area-'.$id.'"></div>'; } ?>
            </div>

        <?php
    }

}

