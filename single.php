<?php get_header(); ?>

<div id="primary" class="content-area">

    <!-- Sidebar -->
    <?php if ( is_active_sidebar('sidebar-1') ) : ?>
    <aside id="secondary" class="sidebar">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </aside>
    <?php endif; ?>

    <!-- Main Content -->
    <main id="main" class="site-main">

        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
        ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-post fade-in'); ?>>
                    
                    <div class="single-post-wrapper">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="single-post-thumbnail">
                                <?php the_post_thumbnail('large', ['class' => 'responsive-img']); ?>
                            </div>
                        <?php endif; ?>

                        <header class="single-post-header">
                            <h1 class="single-post-title"><?php the_title(); ?></h1>
                            <div class="single-post-meta">
                                Yazar: <?php the_author(); ?> | Tarih: <?php the_date(); ?>
                            </div>
                        </header>

                        <div class="single-post-content post-content">
                            <?php the_content(); ?>
                            <?php
                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Sayfalar:', 'm4v3r4-dev'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>

                        <footer class="single-post-footer">
                            Kategoriler: <?php the_category(', '); ?> | Etiketler: <?php the_tags('', ', '); ?>
                        </footer>
                    </div><!-- .single-post-wrapper -->

                </article>
        <?php
            endwhile;
        else :
            echo '<p>Üzgünüz, yazı bulunamadı.</p>';
        endif;
        ?>

    </main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>
