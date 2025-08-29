<?php get_header(); ?>


<!-- 404 Sayfa İçeriği -->
<div class="error-404-container">
  <div class="error-404-content">
    <h1 class="error-404-title">404</h1>
    <p class="error-404-message">Üzgünüz, aradığınız sayfa bulunamadı.</p>
    <p>Belki de aradığınız içerik başka bir sayfada vardır. Aşağıdan arama yapabilirsiniz:</p>
    
    <!-- WordPress Arama Formu -->
    <?php get_search_form(); ?>
    
    <!-- Ana Sayfaya Dön Butonu -->
    <a href="<?php echo home_url(); ?>" class="button go-home">Ana Sayfaya Dön</a>
  </div>
</div>

<?php get_footer(); ?>
