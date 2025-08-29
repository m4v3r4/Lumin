<?php get_header(); ?>

<div class="container archive-page-wrapper">

    <!-- Yazılar -->
    <main class="archive-main cards-wrapper">
        <?php if ( have_posts() ) : ?>
            <div class="cards-row">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="post-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-card-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="post-card-content">
                            <h2 class="post-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="post-card-meta">
                                <?php the_time('F j, Y'); ?> | <?php the_category(', '); ?>
                            </div>
                            <div class="post-card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <?php echo paginate_links(array(
                    'prev_text' => __('« Önceki', 'mytheme'),
                    'next_text' => __('Sonraki »', 'mytheme'),
                )); ?>
            </div>
        <?php else : ?>
            <p>Henüz yazı yok.</p>
        <?php endif; ?>
    </main>

    <!-- Sidebar -->
    <aside class="archive-sidebar">
        <?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
            <?php dynamic_sidebar( 'primary-widget-area' ); ?>
        <?php endif; ?>
    </aside>

</div>

<?php get_footer(); ?>
