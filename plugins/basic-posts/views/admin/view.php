<?php if (user_can('view_posts')): ?>
    <?php if (!empty($row)): ?>
        <div class="row g-3 ">

            <h4 id="view_record">View Record</h4>

            <div class="row mt-3">                   
                <h1 class="p-0 mb-3"><?=esc($row->title)?></h1>

                <?php if($row->display_featured_image): ?>
                    <label class="text-center  mb-5">
                        <img src="<?= get_image($row->image) ?>" 
                        style="width:100%;max-height:300px;object-fit:cover;" />
                    </label>
                <?php endif?>
                    <div class="d-block">
                    <?=($row->content)?>
                    </div>
            </div>
            
            <div class="mb-3 col-md-4">
                <a href="<?= ROOT ?>/<?= $admin_route ?>/<?= $plugin_route ?>">
                    <button type="button" class="btn btn-secondary text-light mx-3"><i class="fa-solid fa-angles-left"></i>
                        <span id="back"> Back</span></button>
                </a>
            </div>
            <div class="mb-3 col-md-4">
                <a href="<?= ROOT ?>/<?= $admin_route ?>/<?= $plugin_route ?>/delete/<?= $row->id ?>">
                    <button type="submit" class="btn btn-red text-light mx-3"><span id="delete">Delete </span> <i
                            class="fa-solid fa-trash-can"></i></button>
                </a>
            </div>
            <div class="mb-3 col-md-4">
                <a href="<?= ROOT ?>/<?= $admin_route ?>/<?= $plugin_route ?>/edit/<?= $row->id ?>" class="mx-3">
                    <button class="btn btn-blue text-light"><span id="edit" class="mx-2">Edit </span><i
                            class="fa-solid fa-pen"></i></button>
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center" id="that_record_was_not_found">That record was not found!</div>

        <a href="<?= ROOT ?>/<?= $admin_route ?>/<?= $plugin_route ?>">
            <button class="btn btn-blue text-light"><i class="fa-solid fa-angles-left"></i> <span id="back">
                    Back</span></button>
        </a>
    <?php endif ?>

<?php else: ?>

    <div class="alert alert-danger text-center">
        Access denied. You dont have permission for this action
    </div>

<?php endif ?>