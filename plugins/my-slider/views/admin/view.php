<?php if (user_can('view_my_sliders')): ?>
    <?php if (!empty($row)): ?>
        <div class="row g-3 col-md-10 mx-auto shadow p-3 rounded mt-3">

            <h4 id="view_record">View Record</h4>

            <div class="d-flex justify-content-around">
               
        <label class="text-center  mb-2 col-md-12">
            Image: <br>
                <img src="<?=get_image($row->image)?>" class="img-thumbnail" style="cursor:pointer;width:100%;max-width:600px;max-height:400px;object-fit:cover;"/>
            </label>
  
        </div>

            <div class="mb-3 col-md-12">
                <div class="form-control"><b>Caption: </b><?= esc($row->caption) ?></div>
            </div>

            <div class="mb-3 col-md-12">
                <div class="form-control"><b>Link: </b><?= esc($row->link) ?></div>
            </div>

            <div class="mb-3 col-md-12">
                <div class="form-control"><b>Description: </b><?= esc($row->description) ?></div>
            </div>

            <div class="mb-3 col-md-6">
                <div class="form-control"><b>Active: </b><?=esc($row->disabled) ? 'No' : 'Yes'?></div>
            </div>
         
            <div class="mb-3 col-md-6"></div>

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