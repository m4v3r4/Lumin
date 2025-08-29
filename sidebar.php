<?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>

    <!-- Aktif Widget Alanı -->
    <aside id="sidebar" role="complementary" class="sidebar-demo">
        <?php dynamic_sidebar( 'primary-widget-area' ); ?>
    </aside>

<?php else : // Eğer widget eklenmemişse demo içerik ?>

    <aside id="sidebar" role="complementary" class="sidebar-demo">

        <!-- Kategoriler Widget'ı -->
        <div class="widget">
            <h3 class="widget-title">Kategoriler</h3>
            <ul>
                <?php 
                wp_list_categories(array(
                    'title_li' => '',
                    'orderby'  => 'name',
                )); 
                ?>
            </ul>
        </div>

        <!-- Son Yazılar Widget'ı -->
        <div class="widget">
            <h3 class="widget-title">Son Yazılar</h3>
            <ul>
                <?php
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 5,
                    'post_status' => 'publish'
                ));
                foreach ( $recent_posts as $post ) : ?>
                    <li><a href="<?php echo get_permalink( $post['ID'] ); ?>"><?php echo esc_html( $post['post_title'] ); ?></a></li>
                <?php endforeach; wp_reset_query(); ?>
            </ul>
        </div>

        <!-- Sosyal Medya Takip Widget'ı -->
        <div class="widget">
            <h3 class="widget-title">Bizi Takip Edin</h3>
            <div class="social-icons">
                <a href="#" class="social-icon">Fb</a>
                <a href="#" class="social-icon">Tw</a>
                <a href="#" class="social-icon">Ln</a>
            </div>
        </div>

    </aside>

<?php endif; ?>
