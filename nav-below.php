<?php
// =========================
// Pagination (Arşiv ve Liste Sayfaları)
// =========================
?>

<div class="pagination">
    <div class="pagination__buttons">
        <?php
        // Sayfalama linklerini oluştur
        echo paginate_links(array(
            'prev_text' => '<span class="meta-nav">&larr;</span> ' . __('Previous'),
            'next_text' => __('Next') . ' <span class="meta-nav">&rarr;</span>',
            'type'      => 'list', // <ul><li> yapısı ile gelir, CSS ile kolayca stil verebilirsin
        ));
        ?>
    </div>
</div>
