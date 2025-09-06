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
// Tema Customizer Ayarları
// ===========================
function m4v3r4_customize_register($wp_customize) {

    // Tema Renkleri
    $wp_customize->add_section('lumin_colors', [
        'title'    => __('Tema Renkleri', 'm4v3r4-dev'),
        'priority' => 30,
    ]);

    $colors = [
        'primary_color'   => '#FF6266',
        'secondary_color' => '#6c757d',
        'bg_color'        => '#ffffff',
        'text_color'      => '#222222'
    ];

    foreach ($colors as $key => $default) {
        $wp_customize->add_setting($key, [
            'default'           => $default,
            'sanitize_callback' => 'sanitize_hex_color',
        ]);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $key, [
            'label'    => ucfirst(str_replace('_', ' ', $key)),
            'section'  => 'lumin_colors',
            'settings' => $key,
        ]));
    }

    // Font Seçimi
    $wp_customize->add_section('theme_font_section', [
        'title'    => __('Tema Fontu', 'm4v3r4-dev'),
        'priority' => 35,
    ]);
    $wp_customize->add_setting('theme_font', [
        'default'           => "'Fira Code', monospace",
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('theme_font_control', [
        'label'    => __('Tema Fontu', 'm4v3r4-dev'),
        'section'  => 'theme_font_section',
        'settings' => 'theme_font',
        'type'     => 'select',
        'choices'  => [
            "'Fira Code', monospace" => 'Fira Code',
            "Arial, sans-serif"       => 'Arial',
            "'Courier New', monospace"=> 'Courier New',
            "'Roboto', sans-serif"    => 'Roboto',
        ],
    ]);
    // ===========================
// Header Ayarları
// ===========================
$wp_customize->add_section('theme_header_section', [
    'title'    => __('Header Ayarları', 'm4v3r4-dev'),
    'priority' => 40,
]);

// Sticky Header Ayarı
$wp_customize->add_setting('sticky_header', [
    'default'           => true,
    'sanitize_callback' => 'wp_validate_boolean',
]);
$wp_customize->add_control('sticky_header_control', [
    'label'    => __('Sticky Header Aktif', 'm4v3r4-dev'),
    'section'  => 'theme_header_section',
    'settings' => 'sticky_header',
    'type'     => 'checkbox',
]);

// Logo / Başlık Seçeneği
$wp_customize->add_setting('header_display_option', [
    'default'           => 'logo_title',
    'sanitize_callback' => 'sanitize_text_field',
]);

$wp_customize->add_control('header_display_option_control', [
    'label'    => __('Header Görünümü', 'm4v3r4-dev'),
    'section'  => 'theme_header_section',
    'settings' => 'header_display_option',
    'type'     => 'radio',
    'choices'  => [
        'logo_title' => __('Logo + Site Başlığı', 'm4v3r4-dev'),
        'logo'       => __('Sadece Logo', 'm4v3r4-dev'),
        'title'      => __('Sadece Site Başlığı', 'm4v3r4-dev'),
    ],
]);
    // Scroll to Top Ayarı
    $wp_customize->add_section('theme_scroll_section', [
        'title'    => __('Scroll Ayarları', 'm4v3r4-dev'),
        'priority' => 45,
    ]);
    $wp_customize->add_setting('scroll_to_top_enabled', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('scroll_to_top_control', [
        'label'    => __('Scroll to Top Butonu Aktif', 'm4v3r4-dev'),
        'section'  => 'theme_scroll_section',
        'settings' => 'scroll_to_top_enabled',
        'type'     => 'checkbox',
    ]);
}
add_action('customize_register', 'm4v3r4_customize_register');


// ===========================
// CSS ve Font Enqueue
// ===========================
function m4v3r4_enqueue_scripts() {
    wp_enqueue_style('m4v3r4-style', get_stylesheet_uri());

    $theme_font = get_theme_mod('theme_font', "'Fira Code', monospace");

    // Sadece light renkler
    $light_colors = [
        'primary'   => get_theme_mod('primary_color', '#FF6266'),
        'secondary' => get_theme_mod('secondary_color', '#6c757d'),
        'bg'        => get_theme_mod('bg_color', '#ffffff'),
        'text'      => get_theme_mod('text_color', '#222222'),
    ];

    $custom_css = "
        :root {
            --primary-color: {$light_colors['primary']};
            --secondary-color: {$light_colors['secondary']};
            --bg-color: {$light_colors['bg']};
            --text-color: {$light_colors['text']};
        }
        body {
            font-family: {$theme_font};
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background 0.3s ease, color 0.3s ease;
        }
        .btn-primary {
            background-color: var(--primary-color);
            color: #fff;
        }
    ";
    wp_add_inline_style('m4v3r4-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'm4v3r4_enqueue_scripts');


// ===========================
// Sidebar Ayarları Customizer
// ===========================
function m4v3r4_customize_sidebar($wp_customize) {
    // Sidebar Görünümü
    $wp_customize->add_section('theme_sidebar_section', [
        'title'    => __('Sidebar Ayarları', 'm4v3r4-dev'),
        'priority' => 50,
    ]);

    // Sidebar Göster/Gizle
    $wp_customize->add_setting('sidebar_enabled', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);

    $wp_customize->add_control('sidebar_enabled_control', [
        'label'    => __('Sidebar Göster', 'm4v3r4-dev'),
        'section'  => 'theme_sidebar_section',
        'settings' => 'sidebar_enabled',
        'type'     => 'checkbox',
    ]);

    // Sidebar Genişliği
    $wp_customize->add_setting('sidebar_width', [
        'default'           => 250,
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control('sidebar_width_control', [
        'label'    => __('Sidebar Genişliği (px)', 'm4v3r4-dev'),
        'section'  => 'theme_sidebar_section',
        'settings' => 'sidebar_width',
        'type'     => 'number',
        'input_attrs' => [
            'min' => 150,
            'max' => 500,
        ],
    ]);
}
add_action('customize_register', 'm4v3r4_customize_sidebar');


// Sidebar register
function m4v3r4_widgets_init() {
    register_sidebar([
        'name'          => __('Sidebar', 'm4v3r4-dev'),
        'id'            => 'sidebar-1',
        'description'   => __('Blok editör ile düzenlenebilir sidebar', 'm4v3r4-dev'),
        'before_widget' => '<div id="%1$s" class="widget %2$s" style="margin-bottom:30px;">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'm4v3r4_widgets_init');



// ===========================
// Body Class: Sticky Header
// ===========================
function m4v3r4_add_body_classes($classes) {
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
  width: 50px;              /* genişlik sabit */
  height: 50px;             /* yükseklik sabit */
  background: var(--primary-color);
  color: #fff;
  border-radius: 50%;       /* daire yapmak için */
  font-size: 20px;
  text-decoration: none;
  text-align: center;
  line-height: 50px;        /* yazıyı ortalamak için */
  display: none;
  z-index: 999;
  transition: opacity 0.3s ease;
}
#scrollToTop:hover {
  opacity: 0.8;
}
        </style>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const scrollBtn = document.getElementById("scrollToTop");
            window.addEventListener("scroll", function() {
                scrollBtn.style.display = window.scrollY > 200 ? "block" : "none";
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

