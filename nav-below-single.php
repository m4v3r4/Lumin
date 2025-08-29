<?php
// =========================
// Post Navigation (Tekil Yazı)
// =========================

// Önceki ve sonraki yazıya linkleri ayarlıyoruz
$args = array(
    'prev_text' => '<span class="meta-nav">&larr;</span> %title', // Önceki yazı
    'next_text' => '%title <span class="meta-nav">&rarr;</span>' // Sonraki yazı
);

// Navigasyonu ekle
the_post_navigation( $args );
?>
