<?php
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post fade-in'); ?>>
            
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="single-post-thumbnail">
                    <?php the_post_thumbnail('large', ['class' => 'responsive-img']); ?>
                </div>
            <?php endif; ?>

            <header class="single-post-header">
                <h1 class="single-post-title"><?php the_title(); ?></h1>
                <div class="single-post-meta">
                    <span class="author"><?php echo get_the_author(); ?></span> |
                    <span class="date"><?php echo get_the_date(); ?></span>
                </div>
            </header>

            <div class="single-post-content post-content">
                <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Sayfalar:', 'lumin'),
                        'after'  => '</div>',
                    ));
                ?>
            </div>

            <?php
            // Önceki / sonraki yazı linkleri
            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Önceki', 'lumin') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Sonraki', 'lumin') . '</span> <span class="nav-title">%title</span>',
            ));

            // Yorumlar aktifse yorumları göster
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>

        </article>

    <?php
    endwhile; // End of the loop.
    ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>
