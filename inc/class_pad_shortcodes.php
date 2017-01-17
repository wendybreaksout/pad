<?php

/**
 * PAD shortcode class
 */
class PAD_Shortcodes
{

    private static $one_third_first = true;

    /**
     * PAD_Shortcodes constructor.
     */
    public function __construct()
    {
        
    }
    
    
    public function register() {

        add_shortcode('pad_product', array( $this, 'pad_product'));
        add_shortcode('pad_products', array( $this, 'pad_products'));
        add_shortcode('pad_featured_article', array( $this, 'pad_featured_article'));
        add_shortcode('pad_modal', array( $this, 'pad_modal'));
        add_shortcode('one_half', array( $this, 'one_half'));
        add_shortcode('one_half_last', array( $this, 'one_half_last'));
        add_shortcode('button', array( $this, 'button'));
        add_shortcode('pullquote2', array( $this, 'pullquote2'));
        add_shortcode('clearboth', array( $this, 'clearboth'));
        add_shortcode('divider', array( $this, 'divider'));
        add_shortcode('portfolio_grid', array( $this, 'portfolio_grid'));
        add_shortcode('one_third', array( $this, 'one_third'));
        add_shortcode('one_third_last', array( $this, 'one_third_last'));
        add_shortcode('highlight1', array( $this, 'highlight1'));



    }

    public function pad_product( $atts ) {


        /** @var  $name */
        /** @var  $badge_text */
        /** @var  $image_size */
        /** @var  $horizontal */
        /** @var  $image_right */
        /** @var  $word_count */
        /** @var  $card_group */



        $atts_actual = shortcode_atts(
            array(
                'name'                => '',
                'badge_text'          => __('Sale', PAD_THEME_TEXTDOMAIN),
                'image_size'          => 'medium',
                'horizontal'          => 'false',
                'image_right'         => 'false',
                'word_count'          => '-1',
                'card_group'          => ''
            ),
            $atts );


        extract( $atts_actual );

        $word_count = intval( $word_count);

        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'post_count'     => 1,
            'posts_per_page' => 1
        );

        // If name is not set, default to the most recent product.
        if ( !empty( $name )) {
            $args['name'] = $name ;
        }

        $product_query = new WP_Query( $args );

        if ( $product_query->have_posts() ) {

            $output = '<div class="container-fluid pad-product">' ;


            while ( $product_query->have_posts() ) : $product_query->the_post();

                $id = get_the_ID();

                /*
                 * Try to pull two images out of product gallery. Failing that, use featured image.
                 */

                global $product;
                $attachment_ids = $product->get_gallery_attachment_ids();

                $gallery_images = array();
                $attachment_count = 0;
                $attachments_to_display = 2;
                foreach( $attachment_ids as $attachment_id ) {
                    $slide_class = $attachment_count == 0 ? 'product-image-top' : 'product-image-bottom';
                    $post_image_src = wp_get_attachment_image_src($attachment_id, $image_size); 
                    $post_image_html = wp_get_attachment_image( $attachment_id, $image_size , false, array( 'class' => 'attachment-' . $image_size . ' size-' . $image_size . ' img-fluid ' . $slide_class));
                    $img_width = $post_image_src[1];
                    $img_height = $post_image_src[2];
                    $data_str = ' data-width="' . $img_width . '" data-height="' . $img_height . '" />';

                    $post_image_html = str_replace('/>', $data_str, $post_image_html );
                    $post_image_html = '<a href="' . get_permalink( $id ) . '">' . $post_image_html .  '</a>';




                    if ( isset( $post_image_html )) {
                        $gallery_images[ $attachment_count++ ] = $post_image_html;
                    }
                    if ( $attachment_count >= $attachments_to_display ) {
                        break;
                    }

                }


                if ( has_post_thumbnail( $id ) ) {
                    $post_thumbnail_id = get_post_thumbnail_id($id);
                    $post_image_src = wp_get_attachment_image_src($post_thumbnail_id, $image_size );
                    if ( isset( $post_image_src )) {
                        $post_thumbnail_url = $post_image_src[0];
                    }
                    else {
                        $post_thumbnail_url = "http://placehold.it/150x150";
                    }
                }

                $post_title= get_the_title();
                $post_url = get_the_permalink();

                $post_excerpt = get_the_excerpt();
                if ( $word_count === 0 ) {
                    $post_excerpt = '';
                }
                else if ( $word_count > 0 ){
                    $post_excerpt = wp_trim_words( $post_excerpt, $word_count );
                }

                $product = wc_get_product( $id );
                $price = $product->get_price_html();

                if ( $product->is_on_sale() ){
                    $badge = '<span class="pad-onsale">' . $badge_text . '</span>';
                }
                else {
                    $badge = '';
                }

                /*
                 * Add code to get product images, similar to what is shown here:
                 * http://sarathlal.com/get-product-gallery-images-woocommerce/
                 *
                 * Then create transition on hover effect as described here:
                 * http://css3.bradshawenterprises.com/cfimg/
                 */

                if ( count($gallery_images) < $attachments_to_display ) {

                    // TODO: Remove or replace this animation.
                    $image_html = '
                        <div class="view overlay hm-green-strong pad-product-grid-image">
                            <a href="' . $post_url . '">
                              ' . $badge . '
                              <img class="img-fluid pad-thumbnail" src="' .  $post_thumbnail_url . '" alt="' . $post_title . '">
                              <div class="pad-mask mask waves-effect waves-light" data-icon-name="home"></div>
                          </a>
                        </div>
                    ';
                }
                else {

                    if ( $horizontal == 'false') {
                        $hover_slide_class = 'pad-product-hover-slide';
                    }
                    else {
                        $hover_slide_class = 'pad-product-horizontal-hover-slide';
                    }
                    $image_html = '
                        <div class="' . $hover_slide_class . ' pad-product-grid-image">' .
                        $badge .
                        $gallery_images[1] .
                        $gallery_images[0] .
                        '</div>';
                }




                $excerpt_html = '';
                if ( $word_count != 0 ) {
                    $excerpt_html =
                        '<div class="pad-product-excerpt truncate-ellipsis">
                            ' . $post_excerpt .  '
                        </div>';
                }

                $card_html = '
                    <div class="card hoverable pad-card-group" data-mh="'. $card_group .'">
                        ' . $image_html . '
                        <div class="card-block">
                            <!--Title-->
                            <h3 class="card-title"><a href="' . $post_url . '">' . $post_title . '</a></h3>
                                ' . $excerpt_html .  '
                            <div class="pad-product-button">                     
                                <a href="' .  $post_url . '" class="btn pad-theme-color-bg">' .  $price . '</a>
                            </div>
                        </div>
    
                    </div>
                    ';


                if ( $horizontal == 'false') {
                    $output .= '
                    <div class="row pad-product-panel">
                        <div class="col-xs-12 animated slideInLeft pad-product-card-column">
                            '  . $card_html  . '
                        </div> 
                    </div>
                    ';

                }
                else {

                    $desc_html = '
                        <div class="pad-product-grid-desc">
                            <h3><a href="' . $post_url . '">' . $post_title . '</a></h3>
                            <div class="pad-product-excerpt">
                              ' . $post_excerpt .  '
                            </div>
                            <div class="pad-product-button">                     
                                <a href="' .  $post_url . '" class="btn pad-theme-color-bg">' .  $price . '</a>
                            </div>
                        </div>
                    ';

                    if ( $image_right == 'false' ) {

                        $col_1_html = $image_html;
                        $col_2_html = $desc_html;

                        $col_1_class = "pad-image-column";
                        $col_2_class = "pad-desc-column";
                    }
                    else {
                        $col_1_html = $desc_html;
                        $col_2_html = $image_html;

                        $col_1_class = "pad-desc-column";
                        $col_2_class = "pad-image-column";


                    }

                    $output .= '
                        <div class="row pad-product-panel hoverable">
                            <div class="col-sm-6 animated slideInLeft ' . $col_1_class . '">
                                '  . $col_1_html  . '
                            </div>
                            <div class="col-sm-6 animated slideInRight ' . $col_2_class . '">
                                '  . $col_2_html  . '
                            </div>
                        </div>
                    ';

                }


            endwhile;

            $output .= '</div>' ; // end row

        }

        wp_reset_postdata();


        return $output;





    }

 
    public function pad_products( $atts ) {

        /** @var  $stagger */

        $atts_actual = shortcode_atts(
            array(
                'stagger'                => 'false'
            ),
            $atts );


        extract( $atts_actual );

        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'post_count'     => 3,
            'posts_per_page' => 3
        );

        $product_query = new WP_Query( $args );

        $output = '';

        if ( $product_query->have_posts() ) {

            $output = '<div class="container-fluid pad-product-grid">' ;

            $count = 0;

            while ( $product_query->have_posts() ) : $product_query->the_post();

                $is_odd = $count++ % 2;

                $id = get_the_ID();

                /*
                 * Try to pull two images out of product gallery. Failing that, use featured image.
                 */

                global $product;
                $attachment_ids = $product->get_gallery_attachment_ids();

                $gallery_images = array();
                $attachment_count = 0;
                $attachments_to_display = 2;
                foreach( $attachment_ids as $attachment_id ) {
                    $slide_class = $attachment_count == 0 ? 'product-image-top' : 'product-image-bottom';
                    $attachment_image_src = wp_get_attachment_image( $attachment_id, array( 500, 500 ), false, array( 'class' => 'attachment-500x500 size-500x500 img-fluid ' . $slide_class));
                    if ( isset( $attachment_image_src )) {
                        $gallery_images[ $attachment_count++ ] = $attachment_image_src;
                    }
                    if ( $attachment_count >= $attachments_to_display ) {
                        break;
                    }

                }


                if ( has_post_thumbnail( $id ) ) {
                    $post_thumbnail_id = get_post_thumbnail_id($id);
                    $post_image_src = wp_get_attachment_image_src($post_thumbnail_id, array( 500, 500 ));
                    if ( isset( $post_image_src )) {
                        $post_thumbnail_url = $post_image_src[0];
                    }
                    else {
                        $post_thumbnail_url = "http://placehold.it/150x150";
                    }
                }

                $post_title= get_the_title();
                $post_url = get_the_permalink();

                $post_excerpt = get_the_excerpt();

                $product = wc_get_product( $id );
                $price = $product->get_price_html();

                if ( $product->is_on_sale() ){
                    $badge = '<span class="pad-onsale">' . __('Sale!', PAD_THEME_TEXTDOMAIN ) . '</span>';
                }
                else {
                    $badge = '';
                }

                /*
                 * Add code to get product images, similar to what is shown here:
                 * http://sarathlal.com/get-product-gallery-images-woocommerce/
                 *
                 * Then create transition on hover effect as described here:
                 * http://css3.bradshawenterprises.com/cfimg/
                 */

                if ( count($gallery_images) < $attachments_to_display ) {
                    
                    // TODO: Remove or replace this animation. 
                    $image_html = '
                        <div class="view overlay hm-green-strong pad-product-grid-image">
                            <a href="' . $post_url . '">
                              ' . $badge . '
                              <img class="img-fluid pad-thumbnail" src="' .  $post_thumbnail_url . '" alt="' . $post_title . '">
                              <div class="pad-mask mask waves-effect waves-light" data-icon-name="home"></div>
                          </a>
                        </div>
                    ';
                }
                else {
                    $image_html = '
                        <div class="pad-product-hover-slide pad-product-grid-image">' .
                        $gallery_images[1] .
                        $gallery_images[0] .
                        '</div>';
                }


                $desc_html = '
                <div class="pad-product-grid-desc">
                    <h3><a href="' . $post_url . '">' . $post_title . '</a></h3>
                    <div class="pad-product-excerpt">
                      ' . $post_excerpt .  '
                    </div>
                    <div class="pad-product-button">                     
                        <a href="' .  $post_url . '" class="btn pad-theme-color-bg">' .  $price . '</a>
                    </div>
                </div>
            ';

                $card_html = '
                <div class="card hoverable">
                    ' . $image_html . '
                    <div class="card-block">
                        <!--Title-->
                        <h3 class="card-title"><a href="' . $post_url . '">' . $post_title . '</a></h3>

                        <div class="pad-product-excerpt">
                            ' . $post_excerpt .  '
                        </div>
                        <div class="pad-product-button">                     
                            <a href="' .  $post_url . '" class="btn pad-theme-color-bg">' .  $price . '</a>
                        </div>
                    </div>

                </div>
            ';

                if ( $stagger == 'false') {
                    $is_odd = 1;
                }

                if ( $is_odd ) {

                    $col_1_html = $image_html;
                    $col_2_html = $desc_html;

                    $col_1_class = "pad-image-column";
                    $col_2_class = "pad-desc-column";
                }
                else {
                    $col_1_html = $desc_html;
                    $col_2_html = $image_html;

                    $col_1_class = "pad-desc-column";
                    $col_2_class = "pad-image-column";


                }



                $output .= '
                <div class="row pad-product-panel hoverable hidden-xs">
                    <div class="col-sm-6 animated slideInLeft ' . $col_1_class . '">
                        '  . $col_1_html  . '
                    </div>
                    <div class="col-sm-6 animated slideInRight ' . $col_2_class . '">
                        '  . $col_2_html  . '
                    </div>
                </div>
            ';

                $output .= '
                <div class="row pad-product-panel visible-xs-block">
                    <div class="col-xs-12 animated slideInLeft pad-product-card-column">
                        '  . $card_html  . '
                    </div>
                    
                </div>
            ';



            endwhile;

            $output .= '</div>' ; // end row

        }

        wp_reset_postdata();


        return $output;


    }


    public function featured_article_excerpt_length () {
        return PAD_DESKTOP_EXCERPT_WORDS;
    }


    public function pad_featured_article( $atts ) {


        /** @var  $post_count */
        /** @var  $categories */
        /** @var  $category_ids */
        /** @var  $tags */
        /** @var  $card_group */
        /** @var  $id */
        /** @var  $name */




        $atts_actual = shortcode_atts(
            array(
                'post_count'    => 1,
                'categories'    => '',
                'category_ids'  => '',
                'tags'          => '',
                'card_group'    => '',
                'id'            => '',
                'name'          => ''

            ),
            $atts );


        extract( $atts_actual );

        $output = '';

        if ( $id != '' ) {
            $args = array(
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'post_count'     => 1,
                'posts_per_page' => 1,
                'p'             => $id
            );
        }
        else if ( $name != '' ) {
            $args = array(
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'post_count'     => 1,
                'posts_per_page' => 1,
                'name'             => $name
            );
        }
        else {
            $args = array(
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'post_count'     => $post_count,
                'posts_per_page' => $post_count,
                'category_name' => $categories,
                'cat'           => $category_ids,
                'tag'           => $tags
            );
        }



        $product_query = new WP_Query( $args );

        $grid_columns = $this->calculate_grid_columns( $post_count );
        if ( $grid_columns == 0 ) {
            return __('Grid layout support only post counts 1, 2, 3, 4 and 6.', PAD_THEME_TEXTDOMAIN);
        }

        if ( $product_query->have_posts() ) {

            $output .=
                '<div class="pad-featured-article">
                <div class="row">
        ';


            $image = new Pad_Image();

            while ($product_query->have_posts()) : $product_query->the_post();
                $output .= '
                <div class="col-sm-' . $grid_columns . '">
            ';

                $id = get_the_ID();

                $post_title = get_the_title();
                $post_url = get_the_permalink();

                add_filter( 'excerpt_length', array( $this, 'featured_article_excerpt_length' ));
                $post_excerpt = get_the_excerpt();
                remove_filter( 'excerpt_length',array( $this, 'featured_article_excerpt_length' ) );

                $desktop_excerpt = $post_excerpt;
                $tablet_excerpt = wp_trim_words ( $desktop_excerpt, PAD_TABLET_EXCERPT_WORDS );
                $mobile_excerpt = wp_trim_words ( $desktop_excerpt, PAD_MOBILE_EXCERPT_WORDS );




                $image_html = $image->get_image( $id );


                $card_html = '
                <div class="card hoverable pad-card-group" data-mh="'. $card_group .'">
                    ' . $image_html . '
                    <div class="card-block">
                        <!--Title-->
                        <h3 class="card-title"><a href="' . $post_url . '">' . $post_title . '</a></h3>

                        <div class="pad-product-excerpt truncate-ellipsis-6">
                            ' . $mobile_excerpt .  '
                        </div>
                        <div class="pad-article-button">                     
                            <a href="' . $post_url . '" class="btn pad-theme-color-bg">Read more...</a>
                        </div>
                    </div>

                </div>
            ';




                $output .= $card_html;
                $output .= '</div>'; // end column

            endwhile;

            $output .= '</div>'; // end row
            $output .= '</div>'; //end capitalism



            wp_reset_postdata();


        }

        return $output;

    }

    private function calculate_grid_columns( $post_count ) {

        $max_grid_columns = 12;

        switch ( $post_count ) {
            case 1:
            case 2:
            case 3:
            case 4:
            case 6:
                $grid_columns = $max_grid_columns / $post_count ;
                break;
            default:
                $grid_columns = 0;
                break;

        }

        return $grid_columns;
    }
    
    public function pad_modal( $atts, $content ) {
        
        /** @var  $id */
        /** @var  $class */
        /** @var  $title */
        /** @var  $link_text */


        $atts_actual = shortcode_atts(
            array(
                'id'    => 'padModal',
                'class' => '',
                'title'     => 'PAD Modal',
                'link_text' => 'Open Modal'
            ),
            $atts );


        extract( $atts_actual );

        $output = '
            <a href="#" data-toggle="modal" data-target="#' . $id. '">' . $link_text . '</a>
            <div class="modal fade" id="' .  $id . '" class="' . $class .  '" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="' . $id . 'Label">' . $title . '</h4>
                        </div>
                        <div class="modal-body"> ' . do_shortcode ( $content ) . '</div>
                    </div>
                </div>
            </div>
        ';


        return $output ;
        
    }

    public function one_half( $atts, $content ) {

        $atts_actual = shortcode_atts(
            array(

            ),
            $atts );


        extract( $atts_actual );

        $output = '
            <div class="row">
                <div class="col-sm-6"> ' . do_shortcode( $content ) . '
                </div>
            ';

        return $output;

    }

    public function one_half_last( $atts, $content ) {


        $atts_actual = shortcode_atts(
            array(

            ),
            $atts );


        extract( $atts_actual );

        $output = '
                <div class="col-sm-6"> ' . do_shortcode( $content ) . '
                </div>
            </div>
            ';

        return $output;

    }


    public function one_third( $atts, $content ) {

        $atts_actual = shortcode_atts(
            array(

            ),
            $atts );


        extract( $atts_actual );

        $output = '';

        if ( self::$one_third_first === true ) {
            $output .= '<div class="row">';
            self::$one_third_first = false;
        }

        $output .= '
                <div class="col-sm-4"> ' . do_shortcode( $content ) . '
                </div>
            ';

        return $output;

    }

    public function one_third_last( $atts, $content ) {


        $atts_actual = shortcode_atts(
            array(

            ),
            $atts );


        extract( $atts_actual );

        $output = '
                <div class="col-sm-4"> ' . do_shortcode( $content ) . '
                </div>
            </div>
            ';

        // reset first flag.
        self::$one_third_first = false;

        return $output;

    }

    public function button( $atts, $content ) {

        /** @var  $link */
        /** @var  $size */
        /** @var  $color */
        /** @var  $align */


        $atts_actual = shortcode_atts(
            array(
                'link'    => '#',
                'size' => 'not implemented',
                'color'     => 'not implemented',
                'align' => 'center'
            ),
            $atts );


        extract( $atts_actual );

        $output = ' <div class="pad-article-button">                     
                            <a href="' . $link . '" class="btn pad-theme-color-bg">' . do_shortcode( $content ) . '</a>
                    </div>';

        return $output ;


    }

    public function pullquote2 ( $atts, $content ) {

        /** @var  $quotes */
        /** @var  $cite */
        /** @var  $align */


        $atts_actual = shortcode_atts(
            array(
                'quotes'    => 'true',
                'cite'      => '',
                'align' => 'center'
            ),
            $atts );


        extract( $atts_actual );

        $output = '<div class="pullquote2-container">
                        <div class="pullquote2-content">' . $content .  '</div>
                        <div class="pullquote2-citation">' . $cite . '</div>
                   </div>';


        return $output ;

    }

    public function clearboth( $atts ) {

        $atts_actual = shortcode_atts(
            array(

            ),
            $atts );


        extract( $atts_actual );

        $output = '
            <div class="clearboth"></div>';

        return $output;

    }

    public function divider( $atts ) {

        $atts_actual = shortcode_atts(
            array(

            ),
            $atts );


        extract( $atts_actual );

        $output = '
            <div class="divider"></div>';

        return $output;

    }

    public function portfolio_grid( $atts )  {

        /** @var  $column */
        /** @var  $showposts */
        /** @var  $cat */
        /** @var  $disable */



        $atts_actual = shortcode_atts(
            array(
                'column'    => '4',
                'showposts'      => '8',
                'cat' => '',
                'disable' => 'not implemented'
            ),
            $atts );


        extract( $atts_actual );

        // calculate number of grid columns. Default to 4 if column parameter does not compute.
        $grid_columns = $this->calculate_grid_columns( $column ) ;
        $grid_columns = $grid_columns == 0 ? 4 : $grid_columns;

        $column_class = 'col-sm-' . $grid_columns;

        $n_rows =  ceil( $showposts / $column ) ;

        $args = array(
            'post_type'      => 'attachment',
            'post_count'     => $showposts,
            'post_status'    => 'any',
            'posts_per_page' => -1,
            'category_name' => $cat,
        );

        $output = '';
        
        $image_query = new WP_Query( $args );
        if ( $image_query->have_posts() ) {


            $loop_count = 0;
            $row_is_open = true;
            while ($image_query->have_posts()) : $image_query->the_post();

                $id = get_the_ID();
                $post_title = get_the_title();
                $post_url = get_the_permalink();

                $post_image_src = wp_get_attachment_image_src($id, 'thumbnail');
                $post_image_html = wp_get_attachment_image( $id, 'thumbnail', false, array( 'class' => 'attachment-thumbnail size-thumbnail img-fluid '));
                $img_width = $post_image_src[1];
                $img_height = $post_image_src[2];
                $data_str = ' data-width="' . $img_width . '" data-height="' . $img_height . '" title="' . $post_title . '"/>';

                $post_image_html = str_replace('/>', $data_str, $post_image_html );

                if ( ( $loop_count % $column ) == 0 ) {
                    // new row
                    $output .= '<div class="row portfolio-grid-row">';
                    $row_is_open = true;
                }

                $output .= '<div class="portfolio-grid-column ' . $column_class . '">' . $post_image_html . '</div>';

                if ( ( $loop_count % $column ) == $column - 1 ) {
                    // close row
                    $output .= '</div>';
                    $row_is_open = false;
                }

                $loop_count++;



            endwhile;

            // For cases in which post count is not an even multiple of columns
            if ( $row_is_open ) {
                $output .= '</div>';
            }
            

            wp_reset_postdata();


        }

        if ( empty($output) ) {
            $output = '<span class="pad-theme-error">' . sprintf( __('Portfolio could not find attachments for category = %s', PAD_THEME_TEXTDOMAIN ), $cat ) . '</span>';
        }

        return $output;






    }

    public function highlight1( $atts, $content  ) {

        /** @var  $bgcolor */
        /** @var  $textcolor */

        $atts_actual = shortcode_atts(
            array(
                'bgcolor' => '#ffffff',
                'textcolor' => '#000000'
            ),
            $atts );


        extract( $atts_actual );

        $output = '
            <span style="background-color:' . $bgcolor . '; color:' . $textcolor . '" class="hightlight1">' . do_shortcode( $content ) . '</span>';

        return $output;

    }


}