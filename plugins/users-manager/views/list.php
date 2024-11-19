<?php if(user_can('view_users')): ?>

<link rel="stylesheet" href="<?=plugin_http_path('assets/css/style.css')?>">
<div class="table-responsive">

<label style="float:right;margin-bottom:10px;"><small>Page: <?=$pager->page_number?></small></label>

<form class="input-group my-3 mx-auto">
            <input type="text" class="form-control" value="<?=old_value('find', '', 'get')?>" placeholder="Search..." name="find" autofocus="true">
            <button class="input-group-text bg-info text-white" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    <table class="table table-bordered">
        <thead>
            <tr>
           <!--   <th class="bg-body-tertiary " scope="col">#</th>-->
              <th class="bg-body-tertiary " id="first_name" scope="col">First name</th>
              <th class="bg-body-tertiary " id="last_name" scope="col">Last name</th>
              <th class="bg-body-tertiary " id="image" scope="col">Image</th>
              <th class="bg-body-tertiary " id="roles" scope="col">Roles</th>             
              
              <th class="bg-body-tertiary " style="display:flex;justify-content:center;align-items:center;">

              <?php if(user_can('add_user')):?>
              <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>/add">
                <button class="btn btn-lime text-light btn-sm" id="add_new"><i class="fa-solid fa-user-plus"></i> </button>
                </a>
                <?php endif ?>
                
              </th>
            </tr>
        </thead>
        <tbody>
          <?php if(!empty($rows)):?>
            <?php foreach($rows as $row):?>
                <tr> 
             <!--     <th scope="row"><?=$row->id?></th> -->
                  <td><?=esc($row->first_name)?></td>
                  <td><?=esc($row->last_name)?></td>
                  <td>
                    <img src="<?=get_image($row->image)?>" class="img-thumbnail"  style="width:50px;height:50px;object-fit:cover;"/>
                  </td>

                  <td>
                    <?php if(!empty($row->roles)):?>
                      <?php foreach($row->roles as $role):?>
                        <div><small><?=esc(ucfirst($role))?></small></div>
                      <?php endforeach?>
                    <?php endif?>
                  </td>

                  <td style="display:flex;justify-content:center;align-items:center; gap:5px;">

                  <?php if(user_can('view_user_details')):?>
                  <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>/view/<?=$row->id?>">
                    <button class="btn btn-yellow text-light btn-sm" ><i class="fa-solid fa-eye"></i></button>
                  </a>
                  <?php endif ?>

                  <?php if(user_can('edit_user')):?>
                  <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>/edit/<?=$row->id?>">
                    <button class="btn btn-blue text-light btn-sm" ><i class="fa-solid fa-user-pen"></i></button>
                  </a>
                  <?php endif ?>

                  <?php if(user_can('delete_user')):?>
                  <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>/delete/<?=$row->id?>">
                    <button class="btn btn-red text-light btn-sm" ><i class="fa-solid fa-trash-can"></i></button>
                  </a>
                  <?php endif ?>

                  </td>
                </tr>
              <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-between z-3">
      <div></div>
      <!-- funkčnost tlačítka doplnit
      <button type="submit" class="btn btn-red btn-sm text-light z-3" style="height:33px;">Delete Selected</button>-->
      
      <?=$pager->display()?>
  </div>

</div>
<?php else : ?>

<div class="alert alert-danger text-center">
  Access denied. You dont have permission for this action
</div>

<?php endif ?>