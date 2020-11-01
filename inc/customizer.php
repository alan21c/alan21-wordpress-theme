<?php
/**
 * alan21 Theme Customizer
 *
 * @package alan21
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function alan21_customize_register( $wp_customize ) {
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'alan21_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'alan21_customize_partial_blogdescription',
			)
		);
	}
	
	
	/*ALAN21 CUSTOMIZER SETTINGS*/
	$wp_customize->remove_section("colors");
	$wp_customize->remove_section("background_image");
	
	$wp_customize->add_setting('blogdescription_2', array(
		'default' 	=>	'',
		'type'		=>	'option'
	));
	
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blogdescription_2', array(
		'label' 	=>	__('Tagline 2', 'alan21'),  
		'section'	=> 'title_tagline',
		'settings'	=> 'blogdescription_2',
		'priority'	=> 10
	)));
	
	$wp_customize->add_setting('heroimage', array(
		'default' 	=> 	'',
		'type'		=>	'option'
	));
	
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'heroimage', array(
		'label' 	=>	__('Upload the hero image', 'alan21'),  
		'section'	=> 'title_tagline',
		'settings'	=> 'heroimage',
		'priority'	=> 11
	)));
	
}
add_action( 'customize_register', 'alan21_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function alan21_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function alan21_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function alan21_customize_preview_js() {
	wp_enqueue_script( 'alan21-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'alan21_customize_preview_js' );
