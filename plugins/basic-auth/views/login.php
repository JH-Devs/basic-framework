
<link rel="stylesheet" href="<?=ROOT?>/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=ROOT?>/assets/css/custom.css">
<link rel="stylesheet" href="<?=plugin_http_path('assets/css/style.css')?>">
<div class="login ">
  <div class="tab-content form-login">
    <form method="post">
      <?=csrf() ?>
      <div class="text-center mb-5">
        <img src="<?=ROOT?>/assets/images/logo-bg-remove.png" style="width:50%;"/>
        <h3>Login</h3>
      </div>
      
      <?php if(message_success()): ?>
        <div class="alert alert-success text-center">
          <?=esc(message_success('', true))?>
        </div>
      <?php endif ?>

      <?php if(message_fail()): ?>
        <div class="alert alert-danger text-center">
          <?=esc(message_fail('', true))?>
        </div>
      <?php endif ?>

      <div  class="form-outline mb-4">
        <input value="<?=old_value('email')?>" type="email" name="email" class="form-control shadow" placeholder="Email"/>
      </div>

      <div class="form-outline mb-4 ">
        <input value="<?=old_value('password')?>"  type="password" name="password" class="form-control shadow" placeholder="Password"/>
      </div>


      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-800 btn-block mb-4">Login</button>
    </div>

    <!--TODO: toto pak zakomentovat-->
    <div class="row mb-4">

      <div class="col-md-6 d-flex justify-content-center">
        <a href="<?=ROOT?>/<?=$vars['forgot_page']?>">Forgot password?</a>
      </div>

    <div class="col-md-6 text-center">
        <p>Not a member? <a href="<?=ROOT?>/<?=$vars['register_page']?>">Register</a></p>
    </div> 

      </div>
      
    </form>
  </div>
</div>

<script src="<?=plugin_http_path('assets/js/plugin.js')?>"></script>