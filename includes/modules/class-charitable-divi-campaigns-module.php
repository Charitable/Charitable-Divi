<?php 

class Charitable_Divi_Campaigns_Module extends ET_Builder_Module {

    function init() {
        $this->name = esc_html__( 'Campaigns', 'charitable-divi' );
        $this->slug = 'charitable_divi_campaigns';

        $this->whitelisted_fields = array(
            'background_layout',
            'posts_number',
            'columns_number',
            'include_categories',
            'orderby',
            'admin_label',
            'module_id',
            'module_class',
            'sale_badge_color',
            'icon_hover_color',
            'hover_overlay_color',
            'hover_icon',
        );

        $this->fields_defaults = array(
            // 'type'           => array( 'recent' ),
            'background_layout' => array( 'light' ),
            'posts_number'      => array( '12', 'add_default_setting' ),
            'columns_number'    => array( '1' ),
            'orderby'           => array( 'post_date' ),
        );

        $this->main_css_element = '%%order_class%%';
        $this->advanced_options = array(
            'fonts' => array(
                'text'   => array(
                    'label'    => esc_html__( 'Text', 'charitable-divi' ),
                    'css'      => array(
                        'line_height' => "{$this->main_css_element} p",
                    ),
                ),
            ),
            'background' => array(
                'settings' => array(
                    'color' => 'alpha',
                ),
            ),
            'border' => array(),
            'custom_margin_padding' => array(
                'css' => array(
                    'important' => 'all',
                ),
            ),
        );
    }

    /**
     * Define the fields that are displayed for the module.
     *
     * @return  array[] $fields
     * @access  public
     * @since   1.0.0     
     */
    function get_fields() {
        $fields = array(
            // 'type' => array(
            //     'label'           => esc_html__( 'Type', 'charitable-divi' ),
            //     'type'            => 'select',
            //     'option_category' => 'basic_option',
            //     'options'         => array(
            //         'recent'  => esc_html__( 'Recent Products', 'charitable-divi' ),
            //         'featured' => esc_html__( 'Featured Products', 'charitable-divi' ),
            //         'sale' => esc_html__( 'Sale Products', 'charitable-divi' ),
            //         'best_selling' => esc_html__( 'Best Selling Products', 'charitable-divi' ),
            //         'top_rated' => esc_html__( 'Top Rated Products', 'charitable-divi' ),
            //         'product_category' => esc_html__( 'Product Category', 'charitable-divi' ),
            //     ),
            //     'affects'            => array(
            //         'input[name="et_pb_include_categories"]',
            //     ),
            //     'description'        => esc_html__( 'Choose which type of products you would like to display.', 'charitable-divi' ),
            // ),
            'background_layout' => array(
                'label'             => esc_html__( 'Text Color', 'charitable-divi' ),
                'type'              => 'select',
                'option_category'   => 'configuration',
                'options'           => array(
                    'light' => esc_html__( 'Dark', 'charitable-divi' ),
                    'dark'  => esc_html__( 'Light', 'charitable-divi' ),
                ),
                'description'       => esc_html__( 'Here you can choose the value of your text. If you are working with a dark background, then your text should be set to light. If you are working with a light background, then your text should be dark.', 'charitable-divi' ),
            ),
            'posts_number' => array(
                'label'             => esc_html__( 'Campaigns Number', 'charitable-divi' ),
                'type'              => 'text',
                'option_category'   => 'configuration',
                'description'       => esc_html__( 'Control how many campaigns are displayed.', 'charitable-divi' ),
            ),
            // 'include_categories'   => array(
            //     'label'            => esc_html__( 'Include Categories', 'charitable-divi' ),
            //     'type'             => 'basic_option',
            //     'renderer'         => 'et_builder_include_categories_shop_option',
            //     'renderer_options' => array(
            //         'use_terms'    => true,
            //         'term_name'    => 'product_cat',
            //     ),
            //     'depends_show_if'  => 'product_category',
            //     'description'      => esc_html__( 'Choose which categories you would like to include.', 'charitable-divi' ),
            // ),
            'columns_number' => array(
                'label'             => esc_html__( 'Columns Number', 'charitable-divi' ),
                'type'              => 'select',
                'option_category'   => 'layout',
                'options'           => array(
                    // '0' => esc_html__( 'default', 'charitable-divi' ),
                    // '6' => sprintf( esc_html__( '%1$s Columns', 'charitable-divi' ), esc_html( '6' ) ),
                    // '5' => sprintf( esc_html__( '%1$s Columns', 'charitable-divi' ), esc_html( '5' ) ),
                    '4' => sprintf( esc_html__( '%1$s Columns', 'charitable-divi' ), esc_html( '4' ) ),
                    '3' => sprintf( esc_html__( '%1$s Columns', 'charitable-divi' ), esc_html( '3' ) ),
                    '2' => sprintf( esc_html__( '%1$s Columns', 'charitable-divi' ), esc_html( '2' ) ),
                    '1' => esc_html__( '1 Column', 'charitable-divi' ),
                ),
                'description'        => esc_html__( 'Choose how many columns to display.', 'charitable-divi' ),
            ),
            'orderby' => array(
                'label'             => esc_html__( 'Order By', 'charitable-divi' ),
                'type'              => 'select',
                'option_category'   => 'configuration',
                'options'           => array(
                    'post_date'  => esc_html__( 'Sort by Publication Date', 'charitable-divi' ),
                    'popular' => esc_html__( 'Sort By Amount Raised', 'charitable-divi' ),
                    'ending' => esc_html__( 'Sort By Time Remaining', 'charitable-divi' )
                ),
                'description'        => esc_html__( 'Choose how your campaigns should be ordered.', 'charitable-divi' ),
            ),
            // 'sale_badge_color' => array(
            //     'label'             => esc_html__( 'Sale Badge Color', 'charitable-divi' ),
            //     'type'              => 'color',
            //     'custom_color'      => true,
            //     'tab_slug'          => 'advanced',
            // ),
            // 'icon_hover_color' => array(
            //     'label'             => esc_html__( 'Icon Hover Color', 'charitable-divi' ),
            //     'type'              => 'color',
            //     'custom_color'      => true,
            //     'tab_slug'          => 'advanced',
            // ),
            'hover_overlay_color' => array(
                'label'             => esc_html__( 'Hover Overlay Color', 'charitable-divi' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'tab_slug'          => 'advanced',
            ),
            'hover_icon' => array(
                'label'               => esc_html__( 'Hover Icon Picker', 'charitable-divi' ),
                'type'                => 'text',
                'option_category'     => 'configuration',
                'class'               => array( 'et-pb-font-icon' ),
                'renderer'            => 'et_pb_get_font_icon_list',
                'renderer_with_field' => true,
                'tab_slug'            => 'advanced',
            ),
            'disabled_on' => array(
                'label'           => esc_html__( 'Disable on', 'charitable-divi' ),
                'type'            => 'multiple_checkboxes',
                'options'         => array(
                    'phone'   => esc_html__( 'Phone', 'charitable-divi' ),
                    'tablet'  => esc_html__( 'Tablet', 'charitable-divi' ),
                    'desktop' => esc_html__( 'Desktop', 'charitable-divi' ),
                ),
                'additional_att'  => 'disable_on',
                'option_category' => 'configuration',
                'description'     => esc_html__( 'This will disable the module on selected devices', 'charitable-divi' ),
            ),
            'admin_label' => array(
                'label'       => esc_html__( 'Admin Label', 'charitable-divi' ),
                'type'        => 'text',
                'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'charitable-divi' ),
            ),
            'module_id' => array(
                'label'           => esc_html__( 'CSS ID', 'charitable-divi' ),
                'type'            => 'text',
                'option_category' => 'configuration',
                'tab_slug'        => 'custom_css',
                'option_class'    => 'et_pb_custom_css_regular',
            ),
            'module_class' => array(
                'label'           => esc_html__( 'CSS Class', 'charitable-divi' ),
                'type'            => 'text',
                'option_category' => 'configuration',
                'tab_slug'        => 'custom_css',
                'option_class'    => 'et_pb_custom_css_regular',
            ),
        );
        return $fields;
    }

    function shortcode_callback( $atts, $content = null, $function_name ) {
        $module_id               = $this->shortcode_atts['module_id'];
        $module_class            = $this->shortcode_atts['module_class'];
        // $type                    = $this->shortcode_atts['type'];
        // $include_categories      = $this->shortcode_atts['include_categories'];
        $include_categories      = '';
        $posts_number            = $this->shortcode_atts['posts_number'];
        $orderby                 = $this->shortcode_atts['orderby'];
        $columns                 = $this->shortcode_atts['columns_number'];
        // $sale_badge_color        = $this->shortcode_atts['sale_badge_color'];
        // $icon_hover_color        = $this->shortcode_atts['icon_hover_color'];
        $hover_overlay_color     = $this->shortcode_atts['hover_overlay_color'];
        $hover_icon              = $this->shortcode_atts['hover_icon'];

        $module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

        if ( '' !== $hover_overlay_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector'    => '%%order_class%% .et_overlay',
                'declaration' => sprintf(
                    'background-color: %1$s !important;
                    border-color: %1$s;',
                    esc_html( $hover_overlay_color )
                ),
            ) );
        }

        $output = sprintf(
            '<div%2$s class="et_pb_module et_pb_campaigns%2$s%3$s"%4$s>
                %1$s
            </div>',
            do_shortcode(
                sprintf( '[campaigns number="%1$s" orderby="%2$s" columns="%3$s" category="%4$s"]',                    
                    esc_attr( $posts_number ),
                    esc_attr( $orderby ),
                    esc_attr( $columns ),
                    esc_attr( $include_categories )
                )
            ),
            ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
            ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
            '0' === $columns ? ' et_pb_shop_grid' : ''
            // $data_icon
        );

        return $output;
    }
}