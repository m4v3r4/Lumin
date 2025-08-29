<?php get_header(); ?>

<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
        
        <!-- Tekil Yazı -->
        <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

            <!-- Yazı Başlığı -->
            <h1 class="post-title"><?php the_title(); ?></h1>

            <!-- Yazı Meta Bilgisi -->
            <div class="post-meta">
                <?php the_time('F j, Y'); ?> | <?php the_category(', '); ?>
            </div>

            <!-- Öne Çıkan Görsel -->a
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <!-- Yazı İçeriği -->
            <div class="post-content">
                <?php the_content(); ?>
            </div>

        </article>

    <?php endwhile;
endif;
?>

<!-- Sayfalama / Navigasyon -->
<?php get_template_part('nav', 'below'); ?>

<?php get_footer(); ?>
