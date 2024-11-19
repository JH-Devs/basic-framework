
<link rel="stylesheet" href="<?=ROOT?>/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=ROOT?>/assets/css/custom.css">
<link rel="stylesheet" href="<?=plugin_http_path('assets/css/style.css')?>">

<div class="login ">
    <div class="tab-content form-login">

    <form method="post">
    <?=csrf() ?>
        <div class="text-center mb-5">
        <img src="<?=ROOT?>/assets/images/logo-bg-remove.png" style="width:50%;"/>
            <h3>Register</h3>
        </div>

        <div class="form-outline my-2">
            <input value="<?=old_value('first_name')?>" type="text" name="first_name" class="form-control shadow" placeholder="First name" />
            <?php if(!empty($errors['first_name'])):?>
                <small class="text-danger px-2"><?=$errors['first_name']?></small>
            <?php endif?>
        </div>
    
        <div class="form-outline my-2 ">
            <input value="<?=old_value('last_name')?>" type="text" name="last_name" class="form-control shadow" placeholder="Last name"/>
            <?php if(!empty($errors['last_name'])):?>
                <small class="text-danger px-2"><?=$errors['last_name']?></small>
            <?php endif?>
        </div>

        <div class="form-ouline my-2">
            <select class="form-select shadow" name="gender" >
                <option selected>-- Select Gender --</option>
                <option <?=old_select('gender', 'male')?> value="male">Male</option>
                <option <?=old_select('gender', 'female')?> value="female">Female</option>
                <option <?=old_select('gender', 'udefined')?> value="undefined">Undefined</option>
            </select>
            <?php if(!empty($errors['gender'])):?>
                <small class="text-danger px-2"><?=$errors['gender']?></small>
            <?php endif?>
        </div>

        <div class="form-outline my-2 ">
            <input value="<?=old_value('email')?>" type="email" name="email" class="form-control shadow" placeholder="Email" />
            <?php if(!empty($errors['email'])):?>
			  <small class="text-danger px-2"><?=$errors['email']?></small>
			<?php endif?>
        </div>

        <div class="form-outline my-2">
            <input value="<?=old_value('password')?>" type="password" name="password" class="form-control shadow" placeholder="Password"/>
            <?php if(!empty($errors['password'])):?>
                <small class="text-danger px-2"><?=$errors['password']?></small>
            <?php endif?>
        </div>

        <div class="form-outline my-2">
            <input value="<?=old_value('retype_password')?>" type="password" name="retype_password" class="form-control shadow" placeholder="Retype password" />
            <?php if(!empty($errors['retype_password'])):?>
                <small class="text-danger px-2"><?=$errors['retype_password']?></small>
            <?php endif?>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-800 btn-block mb-4">Register</button>
        </div>

        <div class="text-center">
            <p>You have account? <a href="<?=ROOT?>/<?=$vars['login_page']?>">Login</a></p>
        </div>
        </form>
    </div>
</div>

<script src="<?=plugin_http_path('assets/js/plugin.js')?>"></script>