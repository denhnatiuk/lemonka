<?php
function prostor_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'prostor_enqueue_styles' );

add_theme_support( 'custom-logo' );

function prostor_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}

add_action( 'after_setup_theme', 'prostor_custom_logo_setup' );

function prostor_logo () {
    $svg_logo = get_template_part( 'template-parts/svg/logo.svg', get_post_format() );
            
    if ( has_custom_logo() ) {
        echo '<img src="'. esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' ) ) .'">';
    } elseif (is_file($svg_logo)) {
        get_template_part( 'template-parts/header/header', 'image' ); 
    } elseif (is_file($svg_logo)) {
        $svg_logo;
    // } else {
    //     echo '<h1>'. esc_attr( get_bloginfo( 'name' ) ) .'</h1>';
    }
}