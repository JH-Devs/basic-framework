<?php if(user_can('edit_category')): ?>
    <?php if(!empty($row)):?>

<form onsubmit="submit_form(event)" method="post" enctype="multipart/form-data">
    <div class="row g-3 col-md-10 mx-auto shadow p-3 rounded mt-3">
    <?=csrf()?>
        <h4 id="edit_record">Edit Record</h4>

        <?php $errors = get_value('errors') ?? [];
?>

        <div class="mb-3 col-md-6">
            <label for="category" class="form-label" id="category">Category name</label>
            <input value="<?= old_value('category', $row->category) ?>" type="text" class="form-control" name="category" >

            <?php if (!empty($errors['category'])): ?>
                <small class="text-danger px-2"><?= $errors['category'] ?></small>
            <?php endif ?>
        </div>

        <div class="mb-2 col-md-6">
            <label for="active" class="form-label">Active</label>
            <select class="form-select" name="disabled">
                <option <?= old_select('disabled', '0',$row->disabled) ?>  value="0"><?= esc('Yes') ?></option>
                <option <?= old_select('disabled', '1', $row->disabled) ?> value="1"><?= esc('No') ?></option>
            </select>
        </div>

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
    <div class="alert alert-danger text-center" id="that_record_was_not_found">That record was not found!</div>

        <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>">
            <button class="btn btn-blue text-light"><i class="fa-solid fa-angles-left"></i> <span id="back"> Back</span></button>
        </a>
<?php endif?>

<?php else : ?>

<div class="alert alert-danger text-center">
  Access denied. You dont have permission for this action
</div>

<?php endif ?>