<?php get_header(); ?>

<?php
// =========================
// Sayfa İçeriği
// =========================
if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <article class="post">
            <!-- Sayfa Başlığı -->
            <h1 class="post-title"><?php the_title(); ?></h1>

            <!-- Sayfa İçeriği -->
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile;
endif;
?>

<?php get_footer(); ?>
