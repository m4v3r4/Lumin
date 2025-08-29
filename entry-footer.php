<footer class="entry-footer">

    <!-- Yazının kategorilerini göster -->
    <span class="cat-links">
        <?php 
        esc_html_e( 'Categories: ', 'blankslate' ); 
        the_category( ', ' ); // Kategorileri virgülle ayırarak listele
        ?>
    </span>

    <!-- Yazının etiketlerini göster -->
    <span class="tag-links">
        <?php the_tags(); // Etiketleri listele ?>
    </span>

    <!-- Eğer yorumlar açıksa yorum linkini göster -->
    <?php 
    if ( comments_open() ) { 
        echo '<span class="meta-sep">|</span> 
              <span class="comments-link">
                  <a href="' . esc_url( get_comments_link() ) . '">'
                  . sprintf( esc_html__( 'Comments', 'blankslate' ) ) . 
              '</a></span>'; 
    } 
    ?>

</footer>
