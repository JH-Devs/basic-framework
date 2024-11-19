<?php if (user_can('add_category')): ?>
<form method="post" enctype="multipart/form-data">
    <div class="row g-3 col-md-10 mx-auto shadow p-3 rounded mt-3">
    <?=csrf()?>
        <h4 id="add_record">Add Record</h4>
        <?php $errors = get_value('errors') ?? [];
?>

        <div class="mb-3 col-md-12">
            <label for="category" class="form-label" id="category">Category name</label>
            <input value="<?= old_value('category') ?>" type="text" class="form-control" name="category" >

            <?php if (!empty($errors['category'])): ?>
                <small class="text-danger px-2"><?= $errors['category'] ?></small>
            <?php endif ?>
        </div>

        <div class="mb-3 col-md-12">
            <label for="slug" class="form-label" id="slug">Slug (Optional)</label>
            <input value="<?=old_value('slug')?>" type="text" class="form-control" name="slug" >
            
            <?php if (!empty($errors['slug'])): ?>
        <small class="text-danger px-2"><?= $errors['slug'] ?></small>
    <?php endif ?>
        </div>

        <div class="mb-2 col-md-6">
            <label for="active" class="form-label">Active</label>
            <select class="form-select" name="disabled">
                <option <?= old_select('disabled', '0') ?>  value="0"><?= esc('Yes') ?></option>
                <option <?= old_select('disabled', '1') ?> value="1"><?= esc('No') ?></option>
            </select>
        </div>

        <div class="mb-2 col-md-6"></div>

        <div class="mb-3 col-md-6">
            <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>">
                <button type="button" class="btn btn-secondary text-light"><i class="fa-solid fa-angles-left"></i> <span id="back"> Back</span></button>
                </a>
            </div>
        <div class="mb-3 col-md-6">
                <button type="submit" class="btn btn-lime text-light float-end"><span id="save">Save </span> <i class="fa-solid fa-save"></i></button>
        </div>
    </div>
</form>

<?php else: ?>

<div class="alert alert-danger text-center">
    Access denied. You dont have permission for this action
</div>

<?php endif ?>