
<link rel="stylesheet" href="<?=plugin_http_path('assets/css/style.css')?>">

<div class="row col-md-10 p-4 mx-auto shadow" >
    <h1 class=""><?=esc($row->title)?></h1>
    <?php if ($row->display_featured_image): ?>
    <label class="text-center">
        <img src="<?= get_image($row->image) ?>" 
             style="width:100%;max-height:300px;object-fit:cover;" />
    </label>
    <?php endif; ?>

    <div class="d-block" style="min-height:100vh;">
        <?=($row->content)?>

        <?php
        // Kontrola kategorií
        $is_gallery = false;
        if (isset($row->category_rows) && !empty($row->category_rows)) {
            foreach ($row->category_rows as $category) {
                if ($category->slug == 'gallery') {
                    $is_gallery = true;
                    break;
                }
            }
        }

        // Pokud kategorie je 'gallery', zobrazíme galerii, jinak příspěvky
        if ($is_gallery) {
            do_action('gallery-show_gallery', ['row' => $row]);
        } else {
            do_action('basic-posts-show_posts', ['row' => $row]);
        }
    // Zobrazení kontaktního formuláře, pokud je povolený
    if (isset($row->show_contact_form) && $row->show_contact_form) {
        include plugin_path('views/frontend/contact-form.php'); // Načti kontaktní formulář
    }

        ?>
    </div>
</div>

<script src="<?=plugin_http_path('assets/js/plugin.js')?>"></script>
