<div class="entry-meta">

    <!-- Yazar bilgisi -->
    <span class="author vcard"
        <?php 
        // Tekil yazı sayfasında schema.org Person yapısı ekle
        if ( is_single() ) { 
            echo ' itemprop="author" itemscope itemtype="https://schema.org/Person">
                  <span itemprop="name">';
        } else { 
            echo '><span>'; 
        } 
        ?>
        <?php the_author_posts_link(); // Yazar linki ?>
    </span>
    </span>

    <!-- Meta ayırıcı (|) -->
    <span class="meta-sep"> | </span>

    <!-- Yayın tarihi -->
    <time class="entry-date" 
          datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" 
          title="<?php echo esc_attr( get_the_date() ); ?>" 
          <?php if ( is_single() ) { echo 'itemprop="datePublished" pubdate'; } ?>>
        <?php the_time( get_option( 'date_format' ) ); // Yayın tarihi ?>
    </time>

    <!-- Eğer tekil yazı sayfasıysa, güncellenme tarihini meta olarak ekle -->
    <?php 
    if ( is_single() ) { 
        echo '<meta itemprop="dateModified" content="' . esc_attr( get_the_modified_date() ) . '">'; 
    } 
    ?>

</div>
