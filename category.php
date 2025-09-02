<?php get_header(); ?>

<div id="primary" class="content-area category-page">
    <main id="main" class="site-main">

        <header class="archive-header">
            <h1 class="archive-title"><?php single_cat_title(); ?></h1>

            <?php if ( get_the_archive_description() ) : ?>
                <div class="archive-description">
                    <?php echo wp_kses_post( get_the_archive_description() ); ?>
                </div>
            <?php endif; ?>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="post-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                        <a href="<?php the_permalink(); ?>" class="post-thumb">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('medium_large', ['class' => 'post-image']); ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/no-image.jpg" alt="<?php the_title(); ?>" class="post-image">
                            <?php endif; ?>
                        </a>

                        <div class="post-content">
                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="post-meta">
                                <span class="post-date"><?php echo get_the_date(); ?></span> | 
                                <span class="post-author"><?php the_author(); ?></span>
                            </div>
                            <div class="post-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="read-more">Devamını Oku →</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Sayfalama -->
            <div class="pagination">
                <?php
                the_posts_pagination([
                    'mid_size'  => 2,
                    'prev_text' => __('← Önceki', 'lumin'),
                    'next_text' => __('Sonraki →', 'lumin'),
                ]);
                ?>
            </div>

        <?php else : ?>
            <p class="no-posts">Bu kategoride içerik bulunamadı.</p>
        <?php endif; ?>

    </main>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
