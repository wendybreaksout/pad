<?php

/**
 * 
 */
class PAD_Theme_Settings
{
    private $options_name = PAD_THEME_OPTIONS_NAME;

    private $version = PAD_THEME_VERSION ;

    private $default_display_site_title = true;
    private $default_display_site_tagline = true;
    private $default_display_logo = true;

    private $default_logo_height = PAD_LOGO_DEFAULT_HEIGHT;
    private $default_logo_width = PAD_LOGO_DEFAULT_WIDTH;
    private $default_nav_change_scroll_threshold = PAD_NAV_CHANGE_SCROLL_THRESHOLD;

    private $default_show_archive_full_text = false;
    private $default_display_blog_sidebar = true;
    private $default_display_single_post_sidebar = true;



    /**
     * Constructor
     *
     * @since 0.0.1
     */
    public function __construct() {

    }

    /*
	 * Get the theme options name.
	 *
	 * @return string theme options name.
	 */
    public function get_options_name() {
        return $this->options_name;
    }

    /*
	 * This function was intended to be called to delete the
	 * options from the database.
	 *
	 * @since 0.0.1
	 */

    public function delete_options() {
        if ( current_user_can('delete_plugins') ) {
            delete_option($this->options_name );
        }
    }

    /*
	 * This method defines the theme settings page.
	 *
	 * @since 1.0.0
	 *
	 * @param none
	 * @return void
	 */
    public function settings_init(  ) {

        register_setting( 'pad-theme-settings-group', $this->options_name, array( $this, 'sanitize') );

        add_settings_section(
            'pad-theme-settings-general-section',
            __( 'PAD Theme General Settings', PAD_THEME_TEXTDOMAIN ),
            array($this, 'section_general_render'),
            'pad-theme-settings-page'
        );


        add_settings_field(
            'display_site_title',
            __( 'Display site title', PAD_THEME_TEXTDOMAIN ),
            array($this, 'display_site_title_render'),
            'pad-theme-settings-page',
            'pad-theme-settings-general-section'
        );

        add_settings_field(
            'display_site_tagline',
            __( 'Display site tagline', PAD_THEME_TEXTDOMAIN ),
            array($this, 'display_site_tagline_render'),
            'pad-theme-settings-page',
            'pad-theme-settings-general-section'
        );

        add_settings_field(
            'display_logo',
            __( 'Display logo', PAD_THEME_TEXTDOMAIN ),
            array($this, 'display_logo_render'),
            'pad-theme-settings-page',
            'pad-theme-settings-general-section'
        );

        add_settings_field(
            'logo_width',
            __( 'Logo Width', PAD_THEME_TEXTDOMAIN ),
            array($this, 'logo_width_render'),
            'pad-theme-settings-page',
            'pad-theme-settings-general-section'
        );

        add_settings_field(
            'logo_height',
            __( 'Logo Height', PAD_THEME_TEXTDOMAIN ),
            array($this, 'logo_height_render'),
            'pad-theme-settings-page',
            'pad-theme-settings-general-section'
        );

        add_settings_field(
            'nav_change_scroll_threshold',
            __( 'Navigation Change Scroll Threshold', PAD_THEME_TEXTDOMAIN ),
            array($this, 'nav_change_scroll_threshold_render'),
            'pad-theme-settings-page',
            'pad-theme-settings-general-section'
        );

        add_settings_field(
            'show_archive_full_text',
            __( 'Show full text in archive listings (instead of an excerpt)', PAD_THEME_TEXTDOMAIN ),
            array($this, 'show_archive_full_text_render'),
            'pad-theme-settings-page',
            'pad-theme-settings-general-section'
        );

        add_settings_field(
            'display_blog_sidebar',
            __( 'Display right sidebar with blog/archive listings', PAD_THEME_TEXTDOMAIN ),
            array($this, 'display_blog_sidebar_render'),
            'pad-theme-settings-page',
            'pad-theme-settings-general-section'
        );

        add_settings_field(
            'display_single_post_sidebar',
            __( 'Display right sidebar with single post listings', PAD_THEME_TEXTDOMAIN ),
            array($this, 'display_single_post_sidebar_render'),
            'pad-theme-settings-page',
            'pad-theme-settings-general-section'
        );
    }


    /*
     * Render general settings section info.
     * @since 0.0.1
     */
    public function section_general_render () {
        echo '<p>' . __("General settings for PAD Theme", PAD_THEME_TEXTDOMAIN) . '</p>';
    }

    /*
     * Render display site title checkbox field.
     * @since 1.0.0
     */
    public function display_site_title_render(  ) {

        $options = get_option( $this->options_name );
        if ( isset($options['display_site_title'] )) {
            $display_site_title = $options['display_site_title'] ;
        }
        else {
            $display_site_title = $this->default_display_site_title;
        }
        ?>
        <input id="pad_theme_display_site_title_input" type="checkbox" name="pad_theme_settings[display_site_title]" <?php checked( $display_site_title, 1 ); ?> value='1'>
        <br><label for="pad_theme_display_site_title_input"><?php _e('Display site title in header', PAD_THEME_TEXTDOMAIN) ?></label>
        <?php

    }

    public function display_site_tagline_render(  ) {

        $options = get_option( $this->options_name );
        if ( isset($options['display_site_tagline'] )) {
            $display_site_tagline = $options['display_site_tagline'] ;
        }
        else {
            $display_site_tagline = $this->default_display_site_tagline;
        }
        ?>
        <input id="pad_theme_display_site_tagline_input" type="checkbox" name="pad_theme_settings[display_site_tagline]" <?php checked( $display_site_tagline, 1 ); ?> value='1'>
        <br><label for="pad_theme_display_site_tagline_input"><?php _e('Display site tagline in header', PAD_THEME_TEXTDOMAIN) ?></label>
        <?php

    }

    public function display_logo_render(  ) {

        $options = get_option( $this->options_name );
        if ( isset($options['display_logo'] )) {
            $display_logo = $options['display_logo'] ;
        }
        else {
            $display_logo = $this->default_display_logo;
        }
        ?>
        <input id="pad_theme_display_logo_input" type="checkbox" name="pad_theme_settings[display_logo]" <?php checked( $display_logo, 1 ); ?> value='1'>
        <br><label for="pad_theme_display_logo_input"><?php _e('Display logo in header', PAD_THEME_TEXTDOMAIN) ?></label>
        <?php

    }

    /*
    * Render logo height, width fields.
    * @since 1.0.0
    */
    public function logo_width_render(  ) {

        $options = get_option( $this->options_name );
        if ( isset( $options['logo_width'])) {
            $logo_width = $options['logo_width'] ;
        }
        else {
            $logo_width = $this->default_logo_width ;
        }
        ?>
        <input id="pad_theme_logo_width_input" type="number" name="pad_theme_settings[logo_width]" value='<?php echo $logo_width ; ?>'>
        <br><label for="pad_theme_logo_width_input"><?php _e('Set suggested width for site logo', PAD_THEME_TEXTDOMAIN) ?></label>
        <?php

    }

    public function logo_height_render(  ) {

        $options = get_option( $this->options_name );
        if ( isset( $options['logo_height'])) {
            $logo_height = $options['logo_height'] ;
        }
        else {
            $logo_height = $this->default_logo_height ;
        }
        ?>
        <input id="pad_theme_logo_height_input" type="number" name="pad_theme_settings[logo_height]" value='<?php echo $logo_height; ?>'>
        <br><label for="pad_theme_logo_height_input"><?php _e('Set suggested height for site logo', PAD_THEME_TEXTDOMAIN) ?></label>
        <?php

    }

    public function nav_change_scroll_threshold_render(  ) {

        $options = get_option( $this->options_name );
        if ( isset( $options['nav_change_scroll_threshold'])) {
            $nav_change_scroll_threshold = $options['nav_change_scroll_threshold'] ;
        }
        else {
            $nav_change_scroll_threshold = $this->default_nav_change_scroll_threshold ;
        }
        ?>
        <input id="pad_theme_nav_change_scroll_threshold_input" type="number" name="pad_theme_settings[nav_change_scroll_threshold]" value='<?php echo $nav_change_scroll_threshold; ?>'>
        <br><label for="pad_theme_nav_change_scroll_threshold_input"><?php _e('This is the number of pixels to scroll before navigation color and size changes are triggered. Set to -1 to disable this feature.', PAD_THEME_TEXTDOMAIN) ?></label>
        <?php

    }

    public function show_archive_full_text_render(  )
    {

        $options = get_option($this->options_name);
        if (isset($options['show_archive_full_text'])) {
            $show_archive_full_text = $options['show_archive_full_text'];
        } else {
            $show_archive_full_text = $this->default_show_archive_full_text;
        }
        ?>
        <input id="pad_theme_show_archive_full_text_input" type="checkbox"
               name="pad_theme_settings[show_archive_full_text]" <?php checked($show_archive_full_text, 1); ?> value='1'>
        <br><label
        for="pad_theme_show_archive_full_text_input"><?php _e('Show full text (instead of excerpt) in post archive listings', PAD_THEME_TEXTDOMAIN) ?></label>
        <?php

    }

    public function display_blog_sidebar_render(  )
    {

        $options = get_option($this->options_name);
        if (isset($options['display_blog_sidebar'])) {
            $display_blog_sidebar = $options['display_blog_sidebar'];
        } else {
            $display_blog_sidebar = $this->default_display_blog_sidebar;
        }
        ?>
        <input id="pad_theme_display_blog_sidebar_input" type="checkbox"
               name="pad_theme_settings[display_blog_sidebar]" <?php checked($display_blog_sidebar, 1); ?> value='1'>
        <br><label
        for="pad_theme_display_blog_sidebar_input"><?php _e('Display right sidebar with blog post archive listings.', PAD_THEME_TEXTDOMAIN) ?></label>
        <?php

    }

    public function display_single_post_sidebar_render(  )
    {

        $options = get_option($this->options_name);
        if (isset($options['display_single_post_sidebar'])) {
            $display_single_post_sidebar = $options['display_single_post_sidebar'];
        } else {
            $display_single_post_sidebar = $this->default_display_single_post_sidebar;
        }
        ?>
        <input id="pad_theme_display_single_post_sidebar_input" type="checkbox"
               name="pad_theme_settings[display_single_post_sidebar]" <?php checked($display_single_post_sidebar, 1); ?> value='1'>
        <br><label
        for="pad_theme_display_single_post_sidebar_input"><?php _e('Display right sidebar with single blog post.', PAD_THEME_TEXTDOMAIN) ?></label>
        <?php

    }
    /*
	 * Calls add_options_page to register the page and menu item.
	 * 
	 * @since 0.0.1
	 * 
	 * @param none
	 */
    public function add_pad_theme_options_page( ) {

        // Add the top-level admin menu
        $page_title = 'PAD Theme Settings';
        $menu_title = 'PAD Theme';
        $capability = 'manage_options';
        $menu_slug = 'pad-theme-settings';
        $function = 'settings_page';
        add_options_page($page_title, $menu_title, $capability, $menu_slug, array($this, $function)) ;


    }

    /*
	 * Defines and displays the plugin settings page.
	 * @since 0.0.1
	 * 
	 * @param none
	 * @return none
	 */
    public function settings_page(  ) {

        $this->add_option_defaults();

        ?>
        <div class="wrap">
            <form action='options.php' method='post'>

                <h2>PAD Theme Settings</h2>
                <div id="pad-theme-settings-container">
                    <?php

                    settings_fields( 'pad-theme-settings-group' );
                    do_settings_sections( 'pad-theme-settings-page' );
                    submit_button();
                    ?>
                </div>
                <div id="pad-theme-settings-info-container">
                    <h3>PAD Theme</h3>
                    <p><em> Version: <?php echo $this->version ?></em></p>
                </div>


            </form>
        </div>
        <?php

    }

    /*
         * Sanitize user input before passing values on to update options.
         * @since 1.0.0
         */
    public function sanitize( $input ) {

        $new_input = array();

        if( isset( $input['display_site_title'] ) ) {
            $new_input['display_site_title'] = sanitize_text_field( $input['display_site_title'] );
        }
        else {
            // set to default 
            $new_input['display_site_title'] = false ;
        }

        if( isset( $input['display_site_tagline'] ) ) {
            $new_input['display_site_tagline'] = sanitize_text_field( $input['display_site_tagline'] );
        }
        else {
            // set to default
            $new_input['display_site_tagline'] = false ;
        }

        if( isset( $input['display_logo'] ) ) {
            $new_input['display_logo'] = sanitize_text_field( $input['display_logo'] );
        }
        else {
            // set to default
            $new_input['display_logo'] = false ;
        }


        if( isset( $input['logo_width'] ) ) {
            $new_input['logo_width'] = intval( $input['logo_width'] );
        }
        else {
            // set to default
            $new_input['logo_width'] = PAD_LOGO_DEFAULT_WIDTH ;
        }

        if( isset( $input['logo_height'] ) ) {
            $new_input['logo_height'] = intval( $input['logo_height'] );
        }
        else {
            // set to default
            $new_input['logo_height'] = PAD_LOGO_DEFAULT_HEIGHT ;
        }

        if( isset( $input['nav_change_scroll_threshold'] ) ) {
            $new_input['nav_change_scroll_threshold'] = intval( $input['nav_change_scroll_threshold'] );
        }
        else {
            // set to default
            $new_input['nav_change_scroll_threshold'] = $this->default_nav_change_scroll_threshold ;
        }

        if( isset( $input['show_archive_full_text'] ) ) {
            $new_input['show_archive_full_text'] = sanitize_text_field( $input['show_archive_full_text'] );
        }
        else {
            // set to default
            $new_input['show_archive_full_text'] = $this->default_show_archive_full_text ;
        }

        if( isset( $input['display_blog_sidebar'] ) ) {
            $new_input['display_blog_sidebar'] = sanitize_text_field( $input['display_blog_sidebar'] );
        }
        else {
            // set to default
            $new_input['display_blog_sidebar'] = false;
        }

        if( isset( $input['display_single_post_sidebar'] ) ) {
            $new_input['display_single_post_sidebar'] = sanitize_text_field( $input['display_single_post_sidebar'] );
        }
        else {
            // set to default
            $new_input['display_single_post_sidebar'] = false;
        }

        return $new_input ;
    }

    public function add_option_defaults() {

        if ( current_user_can('install_themes') ) {

            if ( get_option( PAD_THEME_OPTIONS_NAME ) === false ) {
                $options = array();

                $options['display_site_title'] = $this->default_display_site_title;

                add_option( $this->options_name, $options );
            }

        }

    }

}