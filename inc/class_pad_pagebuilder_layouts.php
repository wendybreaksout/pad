<?php

/**
 * Created by PhpStorm.
 * User: weskempferjr
 * Date: 10/11/16
 * Time: 2:20 PM
 */
class PAD_PageBuilder_Layouts
{

    /**
     * PAD_PageBuilder_Layouts constructor.
     */
    public function __construct()
    {
    }

    public function register() {
        add_filter('siteorigin_panels_prebuilt_layouts', array( $this, 'pad_prebuilt_layouts'));
    }

    public function pad_prebuilt_layouts( $layouts ) {
        
        $layouts['home-page'] = array(
            // We'll add a title field
            'name' => __('PAD Home', 'pad'),    // Required
            'description' => __('The layout for the PAD home page', 'pad'),    // Optional
            'widgets' =>
                array (
                    0 =>
                        array (
                            'frames' =>
                                array (
                                    0 =>
                                        array (
                                            'background_image' => 3247,
                                            'background_image_fallback' => 'http://layouts.siteorigin.com/wp-content/uploads/2015/08/cameras-690557_1280.jpg#1280x853',
                                            'background_color' => false,
                                            'background_image_type' => 'cover',
                                            'foreground_image' => 0,
                                            'foreground_image_fallback' => '',
                                            'url' => '',
                                            'background_videos' =>
                                                array (
                                                ),
                                            'new_window' => false,
                                        ),
                                ),
                            'controls' =>
                                array (
                                    'speed' => 800,
                                    'timeout' => 8000,
                                    'nav_color_hex' => '#FFFFFF',
                                    'nav_style' => 'thin',
                                    'nav_size' => 25,
                                    'swipe' => true,
                                    'so_field_container_state' => 'closed',
                                ),
                            '_sow_form_id' => '57f60281da38f',
                            'panels_info' =>
                                array (
                                    'class' => 'SiteOrigin_Widget_Slider_Widget',
                                    'raw' => false,
                                    'grid' => 0,
                                    'cell' => 0,
                                    'id' => 0,
                                    'widget_id' => '72707d16-7046-4700-89aa-1bdeafd183ee',
                                    'style' =>
                                        array (
                                            'class' => 'target-animated-widget-greeting-text',
                                            'background_display' => 'tile',
                                        ),
                                ),
                        ),
                    1 =>
                        array (
                            'title' => '',
                            'text' => 'Wouldn\'t you rather be here?',
                            'filter' => true,
                            'panels_info' =>
                                array (
                                    'class' => 'WP_Widget_Text',
                                    'raw' => false,
                                    'grid' => 0,
                                    'cell' => 0,
                                    'id' => 1,
                                    'widget_id' => '34723ca0-b7ec-4851-b487-802c1f1fc12b',
                                    'style' =>
                                        array (
                                            'class' => 'animated-greeting-text ',
                                            'background_display' => 'tile',
                                        ),
                                ),
                        ),
                    2 =>
                        array (
                            'headline' =>
                                array (
                                    'text' => 'PAD wants you to build the life that you dream.',
                                    'tag' => 'h1',
                                    'color' => '#404040',
                                    'font' => 'Helvetica Neue',
                                    'font_size' => false,
                                    'font_size_unit' => 'px',
                                    'align' => 'center',
                                    'line_height' => false,
                                    'line_height_unit' => 'px',
                                    'margin' => false,
                                    'margin_unit' => 'px',
                                    'so_field_container_state' => 'open',
                                ),
                            'sub_headline' =>
                                array (
                                    'text' => 'We help people change their home to change their lives. Our ebooks, construction plans and in-person education teaches tiny house builders and DIY land developers to make home work for them.',
                                    'tag' => 'p',
                                    'color' => '#404040',
                                    'font' => 'default',
                                    'font_size' => false,
                                    'font_size_unit' => 'px',
                                    'align' => 'center',
                                    'line_height' => false,
                                    'line_height_unit' => 'px',
                                    'margin' => false,
                                    'margin_unit' => 'px',
                                    'so_field_container_state' => 'open',
                                ),
                            'divider' =>
                                array (
                                    'style' => 'none',
                                    'color' => '#404040',
                                    'thickness' => 1,
                                    'align' => 'center',
                                    'width' => '80%',
                                    'width_unit' => '%',
                                    'margin' => false,
                                    'margin_unit' => 'px',
                                    'so_field_container_state' => 'closed',
                                ),
                            'order' =>
                                array (
                                    0 => 'headline',
                                    1 => 'divider',
                                    2 => 'sub_headline',
                                ),
                            '_sow_form_id' => '57f60ed0dd4ec',
                            'fittext' => false,
                            'panels_info' =>
                                array (
                                    'class' => 'SiteOrigin_Widget_Headline_Widget',
                                    'raw' => false,
                                    'grid' => 1,
                                    'cell' => 0,
                                    'id' => 2,
                                    'widget_id' => '40f53ef8-d4e7-4e96-898b-a02ebf092d92',
                                    'style' =>
                                        array (
                                            'class' => 'pad-intro',
                                            'background_display' => 'tile',
                                        ),
                                ),
                        ),
                    3 =>
                        array (
                            'image' => 4485,
                            'image_fallback' => 'http://layouts.siteorigin.com/wp-content/uploads/2015/08/city-841419_1280.jpg#1280x853',
                            'size' => 'full',
                            'align' => 'default',
                            'title' => '',
                            'title_position' => 'hidden',
                            'alt' => '',
                            'url' => '',
                            'bound' => true,
                            '_sow_form_id' => '57f85ba485dfa',
                            'new_window' => false,
                            'full_width' => false,
                            'panels_info' =>
                                array (
                                    'class' => 'SiteOrigin_Widget_Image_Widget',
                                    'raw' => false,
                                    'grid' => 2,
                                    'cell' => 1,
                                    'id' => 3,
                                    'widget_id' => 'ff63e176-3597-4e3b-ae86-4a6927cf983e',
                                    'style' =>
                                        array (
                                            'background_display' => 'tile',
                                        ),
                                ),
                        ),
                    4 =>
                        array (
                            'type' => 'visual',
                            'title' => '',
                            'text' => '<h2>Start living your dream today!</h2><p>Here are just a few of our most popular <a href="http://padtinyhouses/books-plans/" data-wplink-url-error="true">books and plans</a>.</p>',
                            'filter' => '1',
                            'panels_info' =>
                                array (
                                    'class' => 'WP_Widget_Black_Studio_TinyMCE',
                                    'raw' => false,
                                    'grid' => 3,
                                    'cell' => 0,
                                    'id' => 4,
                                    'widget_id' => '2fec3392-9286-4ceb-93fa-72ef1d423c6e',
                                    'style' =>
                                        array (
                                            'class' => 'pad-product-section',
                                            'background_display' => 'tile',
                                        ),
                                ),
                        ),
                    5 =>
                        array (
                            'title' => '',
                            'text' => '[pad_products]',
                            'filter' => false,
                            'panels_info' =>
                                array (
                                    'class' => 'WP_Widget_Text',
                                    'raw' => false,
                                    'grid' => 3,
                                    'cell' => 0,
                                    'id' => 5,
                                    'widget_id' => '9423c568-3ffe-47df-92c5-4c480e91e0ec',
                                    'style' =>
                                        array (
                                            'background_display' => 'tile',
                                        ),
                                ),
                        ),
                ),
            'grids' =>
                array (
                    0 =>
                        array (
                            'cells' => 1,
                            'style' =>
                                array (
                                    'id' => '#home-slider',
                                    'row_stretch' => 'full-stretched',
                                    'background_display' => 'tile',
                                ),
                        ),
                    1 =>
                        array (
                            'cells' => 1,
                            'style' =>
                                array (
                                    'padding' => '65px',
                                    'row_stretch' => 'full',
                                    'background_display' => 'tile',
                                ),
                        ),
                    2 =>
                        array (
                            'cells' => 3,
                            'style' =>
                                array (
                                    'bottom_margin' => '0px',
                                    'background_display' => 'tile',
                                ),
                        ),
                    3 =>
                        array (
                            'cells' => 1,
                            'style' =>
                                array (
                                    'id' => '#pad-product-section',
                                    'background_display' => 'tile',
                                ),
                        ),
                ),
            'grid_cells' =>
                array (
                    0 =>
                        array (
                            'grid' => 0,
                            'weight' => 1,
                        ),
                    1 =>
                        array (
                            'grid' => 1,
                            'weight' => 1,
                        ),
                    2 =>
                        array (
                            'grid' => 2,
                            'weight' => 0.1000000000000000055511151231257827021181583404541015625,
                        ),
                    3 =>
                        array (
                            'grid' => 2,
                            'weight' => 0.8000000000000000444089209850062616169452667236328125,
                        ),
                    4 =>
                        array (
                            'grid' => 2,
                            'weight' => 0.1000000000000000055511151231257827021181583404541015625,
                        ),
                    5 =>
                        array (
                            'grid' => 3,
                            'weight' => 1,
                        ),
                ),
        );


        $layouts['pad-product-page'] = array (
            'name' => __('PAD Products', 'pad'),    // Required
            'description' => __('A prebuilt layout for PAD products', 'pad'),    // Optional
            'widgets' =>
                array (
                    0 =>
                        array (
                            'title' => '',
                            'text' => '[pad_product name="sweet-pea-tiny-house-plans" horizontal="true"]',
                            'filter' => false,
                            'panels_info' =>
                                array (
                                    'class' => 'WP_Widget_Text',
                                    'raw' => false,
                                    'grid' => 0,
                                    'cell' => 0,
                                    'id' => 0,
                                    'widget_id' => 'ad5d6a2c-4aae-4f55-b177-8e8d720a994d',
                                    'style' =>
                                        array (
                                            'background_display' => 'tile',
                                        ),
                                ),
                        ),
                    1 =>
                        array (
                            'title' => '',
                            'text' => '[pad_product  name="hikari-box-tiny-house-plans" word_count="23"]',
                            'panels_info' =>
                                array (
                                    'class' => 'WP_Widget_Text',
                                    'grid' => 1,
                                    'cell' => 0,
                                    'id' => 1,
                                    'widget_id' => 'e6fb68d3-4829-4832-903b-dd8b89d54db1',
                                    'style' =>
                                        array (
                                            'background_image_attachment' => false,
                                            'background_display' => 'tile',
                                        ),
                                ),
                            'filter' => false,
                        ),
                    2 =>
                        array (
                            'title' => '',
                            'text' => '[pad_product name="don-vardo-downloadable-plans" word_count="23"]',
                            'panels_info' =>
                                array (
                                    'class' => 'WP_Widget_Text',
                                    'grid' => 1,
                                    'cell' => 1,
                                    'id' => 2,
                                    'widget_id' => 'fee8fc53-cc55-4ea7-9b7a-fc5c53b26fe2',
                                    'style' =>
                                        array (
                                            'background_image_attachment' => false,
                                            'background_display' => 'tile',
                                        ),
                                ),
                            'filter' => false,
                        ),
                    3 =>
                        array (
                            'title' => '',
                            'text' => '[pad_product name="sweet-pea-tiny-house-plans" word_count="23"]',
                            'panels_info' =>
                                array (
                                    'class' => 'WP_Widget_Text',
                                    'grid' => 1,
                                    'cell' => 2,
                                    'id' => 3,
                                    'widget_id' => '8912f5a3-d021-4f17-a193-ac377cf1749b',
                                    'style' =>
                                        array (
                                            'background_image_attachment' => false,
                                            'background_display' => 'tile',
                                        ),
                                ),
                            'filter' => false,
                        ),
                    4 =>
                        array (
                            'title' => '',
                            'text' => '[pad_product  name="hikari-box-tiny-house-plans" word_count="0"]',
                            'filter' => false,
                            'panels_info' =>
                                array (
                                    'class' => 'WP_Widget_Text',
                                    'raw' => false,
                                    'grid' => 2,
                                    'cell' => 0,
                                    'id' => 4,
                                    'widget_id' => 'e6fb68d3-4829-4832-903b-dd8b89d54db1',
                                    'style' =>
                                        array (
                                            'background_display' => 'tile',
                                        ),
                                ),
                        ),
                    5 =>
                        array (
                            'title' => '',
                            'text' => '[pad_product name="don-vardo-downloadable-plans" badge_text="Hot Deal!" word_count="0"]',
                            'filter' => false,
                            'panels_info' =>
                                array (
                                    'class' => 'WP_Widget_Text',
                                    'raw' => false,
                                    'grid' => 2,
                                    'cell' => 1,
                                    'id' => 5,
                                    'widget_id' => 'fee8fc53-cc55-4ea7-9b7a-fc5c53b26fe2',
                                    'style' =>
                                        array (
                                            'background_display' => 'tile',
                                        ),
                                ),
                        ),
                    6 =>
                        array (
                            'title' => '',
                            'text' => '[pad_product name="sweet-pea-tiny-house-plans" word_count="0"]',
                            'filter' => false,
                            'panels_info' =>
                                array (
                                    'class' => 'WP_Widget_Text',
                                    'raw' => false,
                                    'grid' => 2,
                                    'cell' => 2,
                                    'id' => 6,
                                    'widget_id' => '8912f5a3-d021-4f17-a193-ac377cf1749b',
                                    'style' =>
                                        array (
                                            'background_display' => 'tile',
                                        ),
                                ),
                        ),
                    7 =>
                        array (
                            'title' => '',
                            'text' => '[pad_product name="go-house-go" word_count="0"]',
                            'filter' => false,
                            'panels_info' =>
                                array (
                                    'class' => 'WP_Widget_Text',
                                    'raw' => false,
                                    'grid' => 2,
                                    'cell' => 3,
                                    'id' => 7,
                                    'widget_id' => '8912f5a3-d021-4f17-a193-ac377cf1749b',
                                    'style' =>
                                        array (
                                            'background_display' => 'tile',
                                        ),
                                ),
                        ),
                ),
            'grids' =>
                array (
                    0 =>
                        array (
                            'cells' => 1,
                            'style' =>
                                array (
                                ),
                        ),
                    1 =>
                        array (
                            'cells' => 3,
                            'style' =>
                                array (
                                ),
                        ),
                    2 =>
                        array (
                            'cells' => 4,
                            'style' =>
                                array (
                                ),
                        ),
                ),
            'grid_cells' =>
                array (
                    0 =>
                        array (
                            'grid' => 0,
                            'weight' => 1,
                        ),
                    1 =>
                        array (
                            'grid' => 1,
                            'weight' => 0.333333333333333314829616256247390992939472198486328125,
                        ),
                    2 =>
                        array (
                            'grid' => 1,
                            'weight' => 0.333333333333333314829616256247390992939472198486328125,
                        ),
                    3 =>
                        array (
                            'grid' => 1,
                            'weight' => 0.333333333333333314829616256247390992939472198486328125,
                        ),
                    4 =>
                        array (
                            'grid' => 2,
                            'weight' => 0.25,
                        ),
                    5 =>
                        array (
                            'grid' => 2,
                            'weight' => 0.25,
                        ),
                    6 =>
                        array (
                            'grid' => 2,
                            'weight' => 0.25,
                        ),
                    7 =>
                        array (
                            'grid' => 2,
                            'weight' => 0.25,
                        ),
                ),
        );
        
        return $layouts;

    }
}