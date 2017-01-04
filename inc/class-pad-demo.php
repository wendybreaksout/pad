<?php

/**
 * 
 */
class Pad_Demo
{

    private static  $demo_images = array(
        'demo_slide_1.jpg',
        'demo_slide_2.jpg'
    );



    /**
     * Hospitality_Demo constructor.
     */
    public function __construct()
    {
    }

    public function load_demo_data() {
        $this->load_demo_images();
    }

    
    private function load_demo_images() {

        $demo_data_dir = plugin_dir_path( dirname( __FILE__ ) ) . 'demo';
        $image_dir = $demo_data_dir . '/images';


        $attachment_ids = array();

        foreach ( self::$demo_images as $image ) {

            $filename = $image_dir . '/' . $image ;
            $upload_file = wp_upload_bits( $image, null, file_get_contents( $filename ));

            if (!$upload_file['error']) {
                $wp_filetype = wp_check_filetype($filename, null );
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'] );
                if (!is_wp_error($attachment_id)) {
                    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                    $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
                    wp_update_attachment_metadata( $attachment_id,  $attachment_data );
                }

                $attachment_ids[] = $attachment_id;
            }
            else {
                return false;
            }
        }

        return $attachment_ids;

    }

}