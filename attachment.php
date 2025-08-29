<?php get_header(); // Tema header.php dosyasını çağırır ?>
<?php global $post; // Global $post objesini kullanılır hale getirir ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); // Döngü başlatılır ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <header class="header">
        <!-- Yazının başlığı -->
        <h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1> 
        
        <!-- Yazı düzenleme linki (sadece yönetici/editor görebilir) -->
        <?php edit_post_link(); ?>
        
        <!-- entry-meta dosyasını dahil eder (yazar, tarih vb.) -->
        <?php get_template_part( 'entry', 'meta' ); ?>
        
        <!-- Ekli resmin bağlı olduğu asıl yazıya geri dönmek için link -->
        <a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" 
           title="<?php printf( esc_attr__( 'Return to %s', 'blankslate' ), esc_attr( get_the_title( $post->post_parent ), 1 ) ); ?>" 
           rev="attachment">
            <?php printf( esc_attr__( '%s Return to ', 'blankslate' ), '<span class="meta-nav">&larr;</span>' ); ?>
            <?php echo wp_kses_post( get_the_title( $post->post_parent ) ); ?>
        </a>

        <!-- Resim navigasyonu (önceki / sonraki resim) -->
        <nav id="nav-above" class="navigation">
            <div class="nav-previous"><?php previous_image_link( false, '&lsaquo;' ); ?></div>
            <div class="nav-next"><?php next_image_link( false, '&rsaquo;' ); ?></div>
        </nav>
    </header>

    <div class="entry-content" itemprop="mainContentOfPage">
        
        <div class="entry-attachment">
            <?php if ( wp_attachment_is_image( $post->ID ) ) : 
                // Eğer eklenen içerik bir resimse, boyut bilgilerini al
                $att_image = wp_get_attachment_image_src( $post->ID, 'full' ); ?>
                
                <!-- Resim görüntüleme -->
                <p class="attachment">
                    <a href="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" 
                       title="<?php the_title_attribute(); ?>" rel="attachment">
                        <img src="<?php echo esc_url( $att_image[0] ); ?>" 
                             width="<?php echo esc_attr( $att_image[1] ); ?>" 
                             height="<?php echo esc_attr( $att_image[2] ); ?>" 
                             class="attachment-full" 
                             alt="<?php echo esc_attr( $post->post_excerpt ); ?>" 
                             itemprop="image">
                    </a>
                </p>
            
            <?php else : // Eğer resim değilse (örneğin PDF, ZIP, vb.) ?>
                <a href="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" 
                   title="<?php echo esc_attr( get_the_title( $post->ID ), 1 ); ?>" 
                   rel="attachment">
                    <?php echo esc_url( basename( $post->guid ) ); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Resim açıklaması varsa göster -->
        <div class="entry-caption">
            <?php if ( !empty( $post->post_excerpt ) ) { the_excerpt(); } ?>
        </div>

        <!-- Öne çıkarılmış görsel varsa göster -->
        <?php if ( has_post_thumbnail() ) { 
            the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) ); 
        } ?>
    </div>
</article>

<!-- Yorumlar bölümü -->
<?php comments_template(); ?>

<?php endwhile; endif; // Döngü sonu ?>
<?php get_footer(); // Tema footer.php dosyasını çağırır ?>
