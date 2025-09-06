<?php get_header(); ?>

<div id="primary" class="content-area" style="display:flex; gap:30px; margin:0 auto; max-width:1200px; padding:20px;">

    <!-- Sidebar -->
    <?php if ( get_theme_mod('sidebar_enabled', true) ) : ?>
<aside id="secondary" class="sidebar" style="flex:0 0 <?php echo get_theme_mod('sidebar_width', 250); ?>px; min-width:150px;">
    <?php get_sidebar(); ?>
</aside>
<?php endif; ?>

    <!-- Main Content -->
    <main id="main" class="site-main" style="flex:1; display:grid; grid-template-columns: repeat(2, 1fr); gap:30px;">

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post fade-in'); ?> style="border:1px solid #ccc; padding:15px; border-radius:8px; display:flex; flex-direction:column;">

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail" style="text-align:center; margin-bottom:15px;">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'responsive-img']); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <header class="post-header" style="margin-bottom:10px;">
                        <h2 class="post-title" style="font-size:1.5rem;">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="post-meta" style="font-size:0.85rem; color:#666;">
                            Yazar: <?php the_author(); ?> | Tarih: <?php the_date(); ?>
                        </div>
                    </header>

                    <div class="post-excerpt" style="line-height:1.6; font-size:1rem;">
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" style="display:inline-block; margin-top:10px;">Devamını oku →</a>
                    </div>

                    <footer class="post-footer" style="margin-top:10px; font-size:0.85rem; color:#666;">
                        Kategoriler: <?php the_category(', '); ?> | Etiketler: <?php the_tags('', ', '); ?>
                    </footer>

                </article>

            <?php endwhile; ?>

            <!-- Pagination -->
            <div class="pagination" style="grid-column:1 / -1; text-align:center; margin-top:20px;">
                <?php
                    echo paginate_links(array(
                        'prev_text' => '« Önceki',
                        'next_text' => 'Sonraki »',
                    ));
                ?>
            </div>

        <?php else : ?>
            <p>Henüz yazı yok.</p>
        <?php endif; ?>

    </main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>
