<?php if (user_can('add_user')): ?>
<form method="post" enctype="multipart/form-data">
    <div class="row g-3 col-md-10 mx-auto shadow p-3 rounded mt-3">
    <?=csrf()?>
        <h4 id="add_record">Add Record</h4>

        <label class="text-center  mb-3">
            <img src="<?=get_image('')?>" class="img-thumbnail" style="cursor:pointer;width:100%;max-width:200px;max-height:200px;object-fit:cover;"/>
            <input onchange="display_image(event)" type="file" name="image" class="d-none">

            <?php if (!empty($errors['image'])): ?>
                <small class="text-danger px-2"><?= $errors['image'] ?></small>
            <?php endif ?>
        </label>
        <?php $errors = get_value('errors') ?? [];
?>

        <div class="mb-3 col-md-6">
            <label for="first_name" class="form-label" id="first_name">First name</label>
            <input value="<?= old_value('first_name') ?>" type="text" class="form-control" name="first_name" >

            <?php if (!empty($errors['first_name'])): ?>
                <small class="text-danger px-2"><?= $errors['first_name'] ?></small>
            <?php endif ?>
        </div>

        <div class="mb-3 col-md-6">
            <label for="last_name" class="form-label" id="last_name">Last name</label>
            <input value="<?=old_value('last_name')?>" type="text" class="form-control" name="last_name" >
            
            <?php if (!empty($errors['last_name'])): ?>
        <small class="text-danger px-2"><?= $errors['last_name'] ?></small>
    <?php endif ?>
        </div>

        <div class="mb-3 col-md-6">
            <label for="gender" class="form-label" id="gender"><?= esc('Gender') ?></label>
            <select class="form-select" name="gender">
                <option value="" id="select_gender" selected><?= esc('Select Gender') ?></option>
                <option <?= old_select('gender', 'male') ?> id="male" value="male"><?= esc('Male') ?></option>
                <option <?= old_select('gender', 'female') ?> id="female" value="female"><?= esc('Female') ?></option>
            </select>
            <?php if (!empty($errors['gender'])): ?>
                <small class="text-danger px-2"><?= $errors['gender'] ?></small>
            <?php endif ?>
        </div>


        <div class="mb-3 col-md-6">
            <label for="email" class="form-label" id="email">Email</label>
            <input value="<?=old_value('email')?>" type="text" class="form-control" name="email" >

            <?php if (!empty($errors['email'])): ?>
            <small class="text-danger px-2"><?= $errors['email'] ?></small>
        <?php endif ?>
        </div>

        <div class="mb-3 col-md-6">
            <label for="password" class="form-label" id="password">Password </label>
            <input value="<?=old_value('password', '')?>" type="password" class="form-control" name="password" >

            <?php if (!empty($errors['password'])): ?>
        <small class="text-danger px-2"><?= $errors['password'] ?></small>
    <?php endif ?>
        </div>
        
        <div class="mb-3 col-md-6">
            <label for="retype_password" class="form-label" id="retype_password">Retype password</label>
            <input  type="password" class="form-control" name="retype_password" >
        </div>

        <div class="mb-3 col-md-12 p-4">
            <label for="role" class="form-label" id="role"><?= esc('Permissions') ?></label>
            <div class="row g-2 border p-2">
				<?php 
                $query = "select * from user_roles where disabled = 0 ";
                    $roles = $user_role->query($query); 
                ?>

					<?php if (!empty($roles)): $num = 0 ?>
						<?php foreach ($roles as $role): $num++ ?>
							<div class="form-check col-md-6">
								<input 
								name="role_<?= $num ?>" class="form-check-input" type="checkbox"
								value="<?= $role->id ?>" id="check<?= $num ?>">
								<label class="form-check-label" for="check<?= $num ?>" style="cursor:pointer;">
								<?= esc(str_replace("_", " ", $role->role)) ?>
								</label>
							</div>
						<?php endforeach ?>
					<?php endif ?>
			</div>
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

<div class="alert alert-danger text-center">
    Access denied. You dont have permission for this action
</div>

<?php endif ?>