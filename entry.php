<?php get_header(); ?>

<div class="container archive-page-wrapper">
    ssss

    <div class="container">
  <main class="content">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article <?php post_class(); ?>>
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="entry-content">
            <?php the_excerpt(); ?>
          </div>
        </article>
      <?php endwhile; ?>
    <?php endif; ?>
  </main>

  <aside class="sidebar">
    <?php get_sidebar(); ?>
  </aside>
</div>

</div>

<?php get_footer(); ?>
