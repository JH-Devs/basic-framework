<?php if (user_can('view_user_details')): ?>
    <?php if (!empty($row)): ?>
        <div class="row g-3 col-md-10 mx-auto shadow p-3 rounded mt-3">

            <h4 id="view_record">View Record</h4>

            <label class="text-center  mb-3">
                <img src="<?= get_image($row->image) ?>" class="img-thumbnail"
                    style="width:100%;max-width:200px;max-height:200px;object-fit:cover;" />
            </label>

            <div class="mb-3 col-md-6">
                <label for="first_name" class="form-label" id="first_name">First name</label>
                <div class="form-control"><?= esc($row->first_name) ?></div>
            </div>

            <div class="mb-3 col-md-6">
                <label for="last_name" class="form-label" id="last_name">Last name</label>
                <div class="form-control"><?= esc($row->last_name) ?></div>
            </div>

            <div class="mb-3 col-md-6">
                <label for="gender" class="form-label " id="gender"><?= esc('Gender') ?></label>
                <div class="form-control"><?= esc(ucfirst($row->gender)) ?></div>
            </div>

            <div class="mb-3 col-md-6">
                <label for="email" class="form-label" id="email">Email</label>
                <div class="form-control"><?= esc($row->email) ?></div>
            </div>

            <div class="mb-3 col-md-12">
                <label for="email" class="form-label" id="roles">Roles</label>
                <div class="form-control">
                <?php if(!empty($row->roles)):?>
                      <?php foreach($row->roles as $role):?>
                        <div><small><?=esc(ucfirst($role))?></small></div>
                      <?php endforeach?>
                    <?php endif?>
                </div>
            </div>

            <div class="mb-3 col-md-6">
                <label for="date_created" class="form-label "><?= esc('Date created') ?></label>
                <div class="form-control"><?=get_date($row->date_created)?></div>
            </div>

            <div class="mb-3 col-md-6">
                <label for="date_updated" class="form-label " ><?= esc('Date Updated') ?></label>
                <div class="form-control"><?=get_date($row->date_updated)?></div>
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