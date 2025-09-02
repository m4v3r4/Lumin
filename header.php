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
  <a href="<?php echo esc_url(home_url()); ?>" class="logo">
    <?php 
    $display = get_theme_mod('logo_title_display', 'both');

    if (($display == 'logo' || $display == 'both') && has_custom_logo()) {
        the_custom_logo();
    }

    if ($display == 'title' || $display == 'both') {
        bloginfo('name');
    }
    ?>
  </a>
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
 <div class="theme-toggle">
   </div>
      <!-- Hamburger menü butonu -->
      <div class="menu-trigger" aria-label="Menüyü aç/kapat" role="button">☰</div>
     

    </div>
    <div>
      <button id="theme-toggle-btn" aria-label="Tema Değiştir">🌙</button>
    </div>
   
    

  </div>
</header>

<!-- =========================
     Menü JS / Mobil alt menü
============================= -->
<script>
  
document.addEventListener("DOMContentLoaded", function () {

  // Alt menüleri aç/kapat (mobil)
  const submenuParents = document.querySelectorAll(".menu__inner li.has-submenu > a");
  submenuParents.forEach(link => {
    link.addEventListener("click", function (e) {
      const li = this.parentElement;
      if (window.innerWidth <= 684) {
        e.preventDefault(); // Linke gitmeyi engelle
        li.classList.toggle("open"); // Alt menüyü aç/kapat
      }
    });
  });

  // Hamburger tıklama
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
