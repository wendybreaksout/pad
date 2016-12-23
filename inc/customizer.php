<?php
/**
 * PAD Theme Customizer.
 *
 * @package PAD
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pad_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_section(
		'light_logo',
		array(
			'title' => 'Light Logo',
			'description' => 'Set light colored logo',
			'priority' => 35,
		)
	);

	$wp_customize->add_setting(
		'light_logo',
		array(
			'default' => 'WTF',
		)
	);

	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'light_logo', array(
		'label' => __( 'Light Logo', PAD_THEME_TEXTDOMAIN ),
		'section' => 'light_logo',
		'mime_type' => 'image',
	) ) );
}
add_action( 'customize_register', 'pad_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pad_customize_preview_js() {
	wp_enqueue_script( 'pad_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'pad_customize_preview_js' );
