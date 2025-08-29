<div id="comments">

<?php
// Eğer yazıya yorum yapılmışsa
if ( have_comments() ) :

    // Yorumları tiplerine göre ayır (yorum ve pingback/trackback)
    global $comments_by_type;
    $comments_by_type = separate_comments( $comments );

    // Standart yorumlar varsa
    if ( !empty( $comments_by_type['comment'] ) ) :
?>
    <section id="comments-list" class="comments">
        <!-- Yorum başlığı -->
        <h2 class="comments-title"><?php comments_number(); ?></h2>

        <!-- Çok sayfalı yorum navigasyonu (üst) -->
        <?php if ( get_comment_pages_count() > 1 ) : ?>
        <nav id="comments-nav-above" class="comments-navigation" role="navigation">
            <div class="paginated-comments-links">
                <?php paginate_comments_links(); ?>
            </div>
        </nav>
        <?php endif; ?>

        <!-- Yorum listesi -->
        <ul>
            <?php wp_list_comments( 'type=comment' ); ?>
        </ul>

        <!-- Çok sayfalı yorum navigasyonu (alt) -->
        <?php if ( get_comment_pages_count() > 1 ) : ?>
        <nav id="comments-nav-below" class="comments-navigation" role="navigation">
            <div class="paginated-comments-links">
                <?php paginate_comments_links(); ?>
            </div>
        </nav>
        <?php endif; ?>
    </section>
<?php
    endif;

    // Pingback ve trackback'ler varsa
    if ( !empty( $comments_by_type['pings'] ) ) :
        $ping_count = count( $comments_by_type['pings'] );
?>
    <section id="trackbacks-list" class="comments">
        <!-- Ping başlığı -->
        <h2 class="comments-title">
            <?php 
            echo '<span class="ping-count">' . esc_html( $ping_count ) . '</span> ' 
                 . esc_html( _nx( 'Trackback or Pingback', 'Trackbacks and Pingbacks', $ping_count, 'comments count', 'blankslate' ) ); 
            ?>
        </h2>

        <!-- Ping/trackback listesi -->
        <ul>
            <?php wp_list_comments( 'type=pings&callback=blankslate_custom_pings' ); ?>
        </ul>
    </section>
<?php
    endif;
endif;

// Eğer yorum yapılabiliyorsa yorum formunu göster
if ( comments_open() ) { 
    comment_form(); 
}
?>

</div>
