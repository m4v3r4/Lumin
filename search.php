<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

    <!-- Arama Sonuç Başlığı -->
    <header class="header">
        <h1 class="entry-title" itemprop="name">
            <?php printf( esc_html__( 'Search Results for: %s', 'blankslate' ), get_search_query() ); ?>
        </h1>
    </header>

    <!-- Arama Sonuçları Listesi -->
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'entry' ); ?>
    <?php endwhile; ?>

    <!-- Sayfalandırma -->
    <?php get_template_part( 'nav', 'below' ); ?>

<?php else : ?>

    <!-- Arama Sonucunda Hiç İçerik Bulunamadıysa -->
    <article id="post-0" class="post no-results not-found">
        <header class="header">
            <h1 class="entry-title" itemprop="name">
                <?php esc_html_e( 'Nothing Found', 'blankslate' ); ?>
            </h1>
        </header>
        <div class="entry-content" itemprop="mainContentOfPage">
            <p><?php esc_html_e( 'Sorry, nothing matched your search. Please try again.', 'blankslate' ); ?></p>
            <?php get_search_form(); ?>
        </div>
    </article>

<?php endif; ?>

<?php get_footer(); ?>
