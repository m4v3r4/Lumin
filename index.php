<?php get_header(); ?>

<div class="container index-page-wrapper" style="display: flex; gap: 40px;">

    <main class="index-main" style="flex: 3;">
        <?php if ( have_posts() ) : ?>
            <div class="cards-row">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article <?php post_class('post-card'); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-card-image">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="post-card-content">
                            <h2 class="post-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="post-card-meta">
                                <?php echo get_the_date(); ?> | <?php the_category(', '); ?>
                            </div>
                            <div class="post-card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination">
                <?php 
                echo paginate_links([
                    'prev_text' => __('« Önceki', 'm4v3r4-dev'),
                    'next_text' => __('Sonraki »', 'm4v3r4-dev'),
                    'type'      => 'list',
                ]); 
                ?>
            </div>

        <?php else : ?>
            <p>Henüz yazı yok.</p>
        <?php endif; ?>
    </main>

    <aside class="index-sidebar" style="flex: 1;">
        <?php 
        if ( is_active_sidebar( 'primary-widget-area' ) ) :
            dynamic_sidebar( 'primary-widget-area' ); 
        endif; 
        ?>
    </aside>

</div>

<?php get_footer(); ?>
