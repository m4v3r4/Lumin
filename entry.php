<?php get_header(); ?>

<div class="container archive-page-wrapper">

    <!-- Ana İçerik -->
    <main class="archive-main">

        <?php if ( have_posts() ) : ?>
            
            <?php while ( have_posts() ) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-card-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <h2 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <div class="post-meta">
                        <?php echo get_the_date(); ?> | <?php the_category(', '); ?>
                    </div>

                    <div class="post-content">
                        <?php the_excerpt(); ?>
                    </div>

                </article>

            <?php endwhile; ?>

            <!-- Pagination -->
            <div class="pagination">
                <?php 
                echo paginate_links(array(
                    'prev_text' => __('« Önceki', 'mytheme'),
                    'next_text' => __('Sonraki »', 'mytheme'),
                    'type'      => 'list',
                )); 
                ?>
            </div>

        <?php else : ?>
            <p>Henüz yazı yok.</p>
        <?php endif; ?>

    </main>

    <!-- Sidebar -->
    <aside class="archive-sidebar">
        <?php 
        if ( is_active_sidebar( 'primary-widget-area' ) ) :
            dynamic_sidebar( 'primary-widget-area' ); 
        else: ?>
            <div class="widget">
                <h3>Kategoriler</h3>
                <ul>
                    <?php wp_list_categories(array('title_li' => '')); ?>
                </ul>
            </div>
        <?php endif; ?>
    </aside>

</div>

<?php get_footer(); ?>
