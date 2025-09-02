<?php
// ===========================
// Tema destekleri
// ===========================
function m4v3r4_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'primary' => __('Primary Menu', 'm4v3r4-dev'),
    ]);
}
add_action('after_setup_theme', 'm4v3r4_theme_setup');

// ===========================
// Widget alanları
// ===========================
function mytheme_widgets_init() {
    register_sidebar([
        'name'          => __('Primary Sidebar', 'mytheme'),
        'id'            => 'primary-widget-area',
        'description'   => __('Ana sidebar alanı', 'mytheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'mytheme_widgets_init');

// ===========================
// CSS ve JS ekleme
// ===========================
function m4v3r4_enqueue_scripts() {
    wp_enqueue_style('m4v3r4-style', get_stylesheet_uri());

    $primary_color = get_theme_mod('primary_color', '#FF6266');
    $background_color = get_theme_mod('background_color', '#221f29');
    $theme_font = get_theme_mod('theme_font', "'Fira Code', monospace");

    $custom_css = "
        body {
            background-color: {$background_color};
            font-family: {$theme_font};
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

// ===========================
// Tema Customizer Ayarları
// ===========================
function mytheme_customize_register($wp_customize) {

    // --- Header Ayarları Bölümü ---
    $wp_customize->add_section('header_settings', [
        'title'    => __('Header Ayarları', 'mytheme'),
        'priority' => 30,
    ]);

    // Sticky Header toggle
    $wp_customize->add_setting('sticky_header', [
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('sticky_header_control', [
        'type'    => 'checkbox',
        'label'   => __('Sticky Header Kullan', 'mytheme'),
        'section' => 'header_settings',
        'settings'=> 'sticky_header',
    ]);

    // --- Renk ayarları ---
    $wp_customize->add_setting('primary_color', [
        'default' => '#FF6266',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color_control', [
        'label' => __('Primary Color', 'mytheme'),
        'section' => 'colors',
        'settings' => 'primary_color',
    ]));

    $wp_customize->add_setting('background_color', [
        'default' => '#221f29',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color_control', [
        'label' => __('Background Color', 'mytheme'),
        'section' => 'colors',
        'settings' => 'background_color',
    ]));

    // --- Font ayarı ---
    $wp_customize->add_setting('theme_font', [
        'default' => "'Fira Code', monospace",
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('theme_font_control', [
        'label'    => __('Theme Font', 'mytheme'),
        'section'  => 'colors',
        'settings' => 'theme_font',
        'type'     => 'select',
        'choices'  => [
            "'Fira Code', monospace" => 'Fira Code',
            "Arial, sans-serif"       => 'Arial',
            "'Courier New', monospace"=> 'Courier New',
            "'Roboto', sans-serif"    => 'Roboto',
        ],
    ]);

    // --- Logo / Site Başlığı Görünümü ---
    $wp_customize->add_section('logo_title_display_section', [
        'title'    => __('Logo / Site Başlığı Görünümü', 'mytheme'),
        'priority' => 45,
    ]);
    $wp_customize->add_setting('logo_title_display', [
        'default'           => 'both',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('logo_title_display_control', [
        'label'    => __('Görünüm Seç', 'mytheme'),
        'section'  => 'logo_title_display_section',
        'settings' => 'logo_title_display',
        'type'     => 'radio',
        'choices'  => [
            'logo'   => __('Sadece Logo', 'mytheme'),
            'title'  => __('Sadece Site Başlığı', 'mytheme'),
            'both'   => __('Logo + Site Başlığı', 'mytheme'),
        ],
    ]);

    // --- Scroll to Top ---
    $wp_customize->add_section('scroll_to_top_section', [
        'title'       => __('Yukarı Çıkma Butonu', 'mytheme'),
        'priority'    => 35,
        'description' => __('Yukarı çıkma butonunu açıp kapatabilirsiniz.', 'mytheme'),
    ]);
    $wp_customize->add_setting('scroll_to_top_enabled', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('scroll_to_top_enabled', [
        'type'    => 'checkbox',
        'section' => 'scroll_to_top_section',
        'label'   => __('Butonu aktif et', 'mytheme'),
    ]);

    // --- Tema Modu ---
    $wp_customize->add_section('lumin_theme_mode', [
        'title' => __('Tema Modu', 'mytheme'),
        'priority' => 40,
    ]);
    $wp_customize->add_setting('lumin_color_mode', [
        'default' => 'dark',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('lumin_color_mode_control', [
        'label'    => __('Tema Modu', 'mytheme'),
        'section'  => 'lumin_theme_mode',
        'settings' => 'lumin_color_mode',
        'type'     => 'radio',
        'choices'  => [
            'dark'  => __('Karanlık', 'mytheme'),
            'light' => __('Açık', 'mytheme'),
        ],
    ]);
}
add_action('customize_register', 'mytheme_customize_register');

// ===========================
// Body Class: Tema Modu ve Sticky
// ===========================
function m4v3r4_add_body_classes($classes) {
    $mode = get_theme_mod('lumin_color_mode', 'dark'); 
    $classes[] = $mode . '-mode';

    if (get_theme_mod('sticky_header', true)) {
        $classes[] = 'header-sticky';
    }
    return $classes;
}
add_filter('body_class', 'm4v3r4_add_body_classes');

// ===========================
// Scroll to Top Butonu
// ===========================
function m4v3r4_scroll_to_top_button() {
    if (get_theme_mod('scroll_to_top_enabled', true)) : ?>
        <a href="#" id="scrollToTop">↑</a>
        <style>
            #scrollToTop {
                position: fixed;
                bottom: 30px;
                right: 30px;
                background: #FF6266;
                color: #fff;
                padding: 10px 15px;
                border-radius: 50%;
                font-size: 20px;
                text-decoration: none;
                text-align: center;
                display: none;
                z-index: 999;
                transition: opacity 0.3s ease;
            }
            #scrollToTop:hover {
                background: #ff4b50;
            }
        </style>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const scrollBtn = document.getElementById("scrollToTop");
            window.addEventListener("scroll", function() {
                if (window.scrollY > 200) scrollBtn.style.display = "block";
                else scrollBtn.style.display = "none";
            });
            scrollBtn.addEventListener("click", function(e) {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
        </script>
    <?php endif;
}
add_action('wp_footer', 'm4v3r4_scroll_to_top_button');

?>
