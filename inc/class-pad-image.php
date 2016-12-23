<?php

/**
 * Created by PhpStorm.
 * User: weskempferjr
 * Date: 10/24/16
 * Time: 7:02 PM
 */
class Pad_Image
{


    /**
     * Pad_Image constructor.
     */
    public function __construct()
    {
    }

    public function get_image( $id ) {

        $image_html = '';
        
        if (has_post_thumbnail($id)) {
            $post_thumbnail_id = get_post_thumbnail_id($id);
            $post_image_src = wp_get_attachment_image_src($post_thumbnail_id, 'medium');
            $post_image_html = wp_get_attachment_image($post_thumbnail_id, 'medium', false, array('class' => 'attachment-medium size-medium img-fluid pad-card-img'));


            $img_width = $post_image_src[1];
            $img_height = $post_image_src[2];
            $data_str = ' data-width="' . $img_width . '" data-height="' . $img_height . '" />';

            $post_image_html = str_replace('/>', $data_str, $post_image_html);
            
            $post_url = get_the_permalink();

            $image_html = '
                <div class="view overlay hm-green-strong pad-featured-article-image">
                    <a href="' . $post_url . '">' . $post_image_html . '
                  </a>
                </div>';
        }
        
        return $image_html  ;
    }
}