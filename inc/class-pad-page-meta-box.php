<?php

/**
 * Created by PhpStorm.
 * User: weskempferjr
 * Date: 10/12/16
 * Time: 3:38 PM
 */
class PAD_Page_Meta_Box extends Pad_Meta_Box {

    public function __construct() {
        $this->setPostType( 'page' );
        $this->setMetaBoxID(  'pad_theme_meta_box' );
        $this->setMetaBoxTitle(  __( 'PAD Theme Page Options', PAD_THEME_TEXTDOMAIN ) );
        $this->setNonceId( 'pad_meta_box_mb_nonce');
        $this->init_tooltips();
    }

    public function remove_meta_boxes () {
        
    }


    public function meta_box_render( ) {
        global $post ;


        wp_nonce_field( basename( __FILE__ ), $this->getNonceId() );

        $post_ID = $post->ID;

        /**
         *
         * Content settings section
         */
        echo '<div class="pad_settings_container">';

        // $this->section_heading(__('PAD Theme Page Options', PAD_THEME_TEXTDOMAIN), 'pad-mb-theme-options');

        $this->text_input( __('CSS class to apply to the body element of this page.', PAD_THEME_TEXTDOMAIN),
            get_post_meta( $post_ID, 'body_class', true),
            'body_class'
        );

        $this->text_input( __('CSS class to apply to the html element of this page.', PAD_THEME_TEXTDOMAIN),
            get_post_meta( $post_ID, 'html_class', true),
            'html_class'
        );

        $this->text_input( __('Carousel title (for when the title is too long to fit in the carousel card title area.)', PAD_THEME_TEXTDOMAIN),
            get_post_meta( $post_ID, 'carousel_title', true),
            'carousel_title'
        );

        echo '&nbsp';

        $this->text_area( __('Text to display over the full width header for this page.', PAD_THEME_TEXTDOMAIN),
            get_post_meta( $post_ID, 'full_width_header_text', true), 5, 50,
            'full_width_header_text'
        );


        echo '</div>';


    }

    public function post_meta_save( $post_id ) {
        // Checks save status
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        
        $is_valid_nonce = ( isset( $_POST[ $this->getNonceId()] ) && wp_verify_nonce( $_POST[ $this->getNonceId() ], basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
            return;
        }
        $this->update_meta_text( $post_id, 'body_class');
        $this->update_meta_text( $post_id, 'html_class');
        $this->update_meta_text( $post_id, 'carousel_title');
        $this->update_meta_text_html( $post_id, 'full_width_header_text');



    }

    protected function init_tooltips() {

        $tooltips = array(

        );

        $this->set_tooltips( $tooltips );

    }
}
