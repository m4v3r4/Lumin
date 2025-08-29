<?php get_header(); ?>

<header class="header">
    <!-- Arşiv başlığı (kategori, etiket, özel taksonomi adı) -->
    <h1 class="entry-title" itemprop="name"><?php single_term_title(); ?></h1>
    
    <!-- Arşiv açıklaması (varsa) -->
    <div class="archive-meta" itemprop="description">
        <?php 
        if ( '' != get_the_archive_description() ) { 
            echo esc_html( get_the_archive_description() ); 
        } 
        ?>
    </div>
</header>

<!-- Ana içerik döngüsü -->
<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <!-- Her yazıyı entry.php dosyasından çağır -->
        <?php get_template_part( 'entry' ); ?>
    <?php endwhile; ?>
<?php else: ?>
    <p>Bu kategoride/etikette içerik bulunamadı.</p>
<?php endif; ?>

<!-- Sayfalama -->
<?php get_template_part( 'nav', 'below' ); ?>

<?php get_footer(); ?>
