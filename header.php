<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- =========================
     Header
============================= -->

<header class="header <?php echo get_theme_mod('sticky_header', true) ? 'header--sticky' : ''; ?>">
  <div class="header__inner">

    <!-- Logo / Site Başlığı -->
<div class="header__logo">
    <?php 
    $display = get_theme_mod('header_display_option', 'logo_title');

    if (($display === 'logo' || $display === 'logo_title') && has_custom_logo()) {
        // Logo kendi linkiyle gelir
        the_custom_logo();
    }

    if ($display === 'title' || $display === 'logo_title') {
        echo '<a href="' . esc_url(home_url()) . '" class="site-title">' . get_bloginfo('name') . '</a>';
    }
    ?>
</div>

    <!-- Menü -->
    <div class="header__menu-wrapper">  
      <nav class="menu">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'primary',
          'menu_class' => 'menu__inner',
          'container' => false,
          'fallback_cb' => false,
        ));
        ?>
      </nav>
      
      <!-- Hamburger menü butonu -->
        <div class="menu-trigger" aria-label="Menüyü aç/kapat" role="button">☰</div>
    </div>
    
    



</header>

<script>
document.addEventListener("DOMContentLoaded", function () {

  // 🔹 Menü işlemleri (mobil)
  const submenuParents = document.querySelectorAll(".menu__inner li.has-submenu > a");
  submenuParents.forEach(link => {
    link.addEventListener("click", function (e) {
      const li = this.parentElement;
      if (window.innerWidth <= 684) {
        e.preventDefault();
        li.classList.toggle("open");
      }
    });
  });

  // 🔹 Hamburger menü
  const menuTrigger = document.querySelector(".menu-trigger");
  const menuInner = document.querySelector(".menu__inner");
  if (menuTrigger) {
    menuTrigger.addEventListener("click", function () {
      menuInner.classList.toggle("show");
    });
  }

  

});
</script>

<!-- Ana içerik başlangıcı -->
<main class="container">
