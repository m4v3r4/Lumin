<div class="entry-summary">

    <?php 
    // Eğer yazının öne çıkan görseli varsa ve sayfa arama sonucu değilse
    if ( ( has_post_thumbnail() ) && ( !is_search() ) ) : 
    ?>
        <!-- Yazının başlığına linkli küçük görsel -->
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail(); ?>
        </a>
    <?php endif; ?>

    <!-- Yazının özeti / excerpt -->
    <div itemprop="description">
        <?php the_excerpt(); ?>
    </div>

    <?php 
    // Eğer arama sonuç sayfasındaysak, sayfa bölünmelerini göster
    if ( is_search() ) { 
    ?>
        <div class="entry-links">
            <?php wp_link_pages(); ?>
        </div>
    <?php } ?>

</div>
