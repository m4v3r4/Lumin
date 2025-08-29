<?php
// Tema destekleri
function m4v3r4_theme_setup() {
    // Başlık ve thumbnail desteği
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // Logo desteği
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Menü kaydı
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'm4v3r4-dev'),
    ));
}
add_action('after_setup_theme', 'm4v3r4_theme_setup');

// Widget alanları
function mytheme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Primary Sidebar', 'mytheme'),
        'id'            => 'primary-widget-area',
        'description'   => __('Ana sidebar alanı', 'mytheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'mytheme_widgets_init');

// CSS ve JS ekleme
function m4v3r4_enqueue_scripts() {
    wp_enqueue_style('m4v3r4-style', get_stylesheet_uri());

    // Customizer renklerini inline ekle
    $primary_color = get_theme_mod('primary_color', '#FF6266');
    $background_color = get_theme_mod('background_color', '#221f29');

    $custom_css = "
        body {
            background-color: {$background_color};
        }
        a, .btn-primary {
            color: {$primary_color};
        }
        .btn-primary, .highlight {
            background-color: {$primary_color};
        }
    ";
    wp_add_inline_style('m4v3r4-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'm4v3r4_enqueue_scripts');

// Tema Customizer ayarlarını ekle
function mytheme_customize_register($wp_customize) {
    
    // 1. Renk Ayarları
    $wp_customize->add_setting('primary_color', array(
        'default' => '#FF6266',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'primary_color_control',
        array(
            'label' => __('Primary Color', 'mytheme'),
            'section' => 'colors',
            'settings' => 'primary_color',
        )
    ));

    $wp_customize->add_setting('background_color', array(
        'default' => '#221f29',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'background_color_control',
        array(
            'label' => __('Background Color', 'mytheme'),
            'section' => 'colors',
            'settings' => 'background_color',
        )
    ));

    // Logo için add_theme_support('custom-logo') kullandık, ayrıca customizer’da hazır gelecektir.
}
add_action('customize_register', 'mytheme_customize_register');
