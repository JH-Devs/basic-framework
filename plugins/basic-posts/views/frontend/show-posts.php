<!-- views/frontend/show-posts.php -->
<form class="input-group my-5 mx-auto" style="width:50%;">
    <input type="text" class="form-control" value="<?=old_value('find', '', 'get')?>" placeholder="Search..." name="find">
    <button class="input-group-text bg-info text-white" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
</form>

<?php if (!empty($posts)): // Zkontrolujeme, zda $posts není prázdné ?>
    <?php foreach ($posts as $post): ?>
        
        <!-- Pokud je příspěvek zakázaný, přeskočíme jeho zobrazení -->
        <?php if ($post->disabled == '1') {
            continue;
        } ?>
        
        <div class="post shadow p-3 mb-2 pb-5">
            <h2 class=""><?= $post->title; ?></h2>
            
            <?php if($post->display_featured_image): ?>
            <div class="featured-image">
                <a href="<?= ROOT ?>/<?= $post->slug; ?>" class="">
                    <img style="width:100%;max-height:300px;object-fit:cover" src="<?= get_image($post->image); ?>" alt="<?= $post->title; ?>" />
                </a>
            </div>
            <?php endif; ?>

            <div class="content mt-2">
                <!-- Zobrazení pouze prvních 250 znaků obsahu -->
                <?= substr($post->content, 0, 250); ?>...
            </div>

            <div class="read-more text-end">
                <!-- Tlačítko Číst více, které odkazuje na detail příspěvku -->
                <a href="<?= ROOT ?>/<?= $post->slug; ?>" class="p-3">Číst více</a>
            </div>
        </div>

    <?php endforeach; ?>
<?php else: ?>
    <div class="alert alert-warning">Žádné příspěvky nebyly nalezeny.</div>
<?php endif; ?>

<div class="d-flex justify-content-between col-md-12">
    <div></div>
    <?php if ($pager): ?>
    <!-- Zde vykreslete stránkování -->
    <?php $pager->display(); ?>
<?php endif; ?>

</div>
