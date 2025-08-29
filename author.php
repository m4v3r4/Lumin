<?php get_header(); ?> 

<!-- Yazar Arşiv Sayfası (author.php) -->
<header class="header">
    <?php the_post(); // İlk yazıyı çeker (yazar bilgilerini almak için) ?>

    <!-- Yazarın Adı -->
    <h1 class="entry-title author" itemprop="name">
        <?php the_author_link(); // Yazarın profil linkiyle adı ?>
    </h1>

    <!-- Yazar Hakkında Kısa Açıklama (Biyografi) -->
    <div class="archive-meta" itemprop="description">
        <?php 
        if ( '' != get_the_author_meta( 'user_description' ) ) { 
            echo esc_html( get_the_author_meta( 'user_description' ) ); 
        } 
        ?>
    </div>

    <?php rewind_posts(); // Döngüyü sıfırla, yazılar listelenmeye hazır ?>
</header>

<!-- Yazarın Yazıları Listeleniyor -->
<?php while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'entry' ); // entry.php dosyası içindeki yazı şablonunu çağır ?>
<?php endwhile; ?>

<!-- Sayfalandırma (önceki / sonraki yazılar) -->
<?php get_template_part( 'nav', 'below' ); ?>

<?php get_footer(); ?>
