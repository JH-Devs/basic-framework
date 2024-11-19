<?php if(user_can('edit_my_slider')): ?>
    <?php if(!empty($row)):?>

<form onsubmit="submit_form(event)" method="post" enctype="multipart/form-data">
    <div class="row g-3 col-md-10 mx-auto shadow p-3 rounded mt-3">
    <?=csrf()?>
        <h4 id="edit_record">Edit Record</h4>


        <div class="d-flex justify-content-around">

        <label class="text-center  mb-3 col-md-12">
        Image: <br>
            <img src="<?=get_image($row->image)?>" class="img-thumbnail" style="cursor:pointer;width:100%;max-width:600px;max-height:400px;object-fit:cover;"/>
            <input onchange="display_image(event)" type="file" name="image" class="d-none">

            <?php if (!empty($errors['image'])): ?>
                <small class="text-danger px-2"><?= $errors['image'] ?></small>
            <?php endif ?>

            <div class="mt-3">
            <input type="checkbox" value="1" name="remove_image"> <small class="text-red"> Remove image</small>
        </div>

        </label>

        <?php $errors = get_value('errors') ?? [];
        ?>
        </div>
        <div class="mb-3 col-md-12">
            <label for="caption" class="form-label" >Caption</label>
            <input value="<?= old_value('caption', $row->caption) ?>" type="text" class="form-control" name="caption" >
        </div>

        <div class="mb-3 col-md-12">
            <label for="link" class="form-label" >Link</label>
            <input value="<?=old_value('link', $row->link)?>" type="text" class="form-control" name="link" >
        </div>

        <div class="mb-3 col-md-12">
            <label for="description" class="form-label" >Description</label>
            <textarea class="form-control" name="description" ><?=old_value('description', $row->description)?></textarea>
        </div>


        <div class="mb-2 col-md-6">
            <label for="active" class="form-label">Active</label>
            <select class="form-select" name="disabled">
                <option <?= old_select('disabled', '0',$row->disabled) ?>  value="0"><?= esc('Yes') ?></option>
                <option <?= old_select('disabled', '1',$row->disabled) ?> value="1"><?= esc('No') ?></option>
            </select>
        </div>
        <div class="mb-3 col-md-6"></div>


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

<script type="text/javascript">
    var valid_image = true;
    function display_image(e)
    {
        let allowed = ['image/jpeg', 'image/png', 'image/webp'];
        let file = e.currentTarget.files[0];

        if (!allowed.includes(file.type)) {
            alert("Only files of this type allowed: " + allowed.toString().replaceAll('image/',''));

            valid_image = false;
            return;
        }
        valid_image = true;
        e.currentTarget.parentNode.querySelector('img').src = URL.createObjectURL(file);
    }
    function submit_form(e)
    {
        if (!valid_image) {
            e.preventDefault()
            alert("Please add a valid image");
            return;
        }
       
    }
</script>
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