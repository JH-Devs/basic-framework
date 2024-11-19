<?php if(user_can('view_my_sliders')): ?>

<link rel="stylesheet" href="<?=plugin_http_path('assets/css/style.css')?>">
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
              <th class="bg-body-tertiary " scope="col">Caption</th>
              <th class="bg-body-tertiary " scope="col">Image</th>     
              <th class="bg-body-tertiary " scope="col">Active</th>
              <th class="bg-body-tertiary " scope="col">Link</th>
              
              <th class="bg-body-tertiary " style="display:flex;justify-content:center;align-items:center;">

              <?php if(user_can('add_my_slider')):?>
              <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>/add">
                <button class="btn btn-lime text-light btn-sm" id="add_new"><i class="fa-solid fa-plus"></i> </button>
                </a>
                <?php endif ?>
                
              </th>
            </tr>
        </thead>
        <tbody>
          <?php if(!empty($rows)):?>
            <?php foreach($rows as $row):?>
                <tr> 
                  <td><?=esc($row->caption)?></td>
                  <td style="text-align: center;">
                    <img src="<?=get_image($row->image)?>" class="img-thumbnail"  style="width:80px;height:80px;object-fit:cover;"/>
                  </td>
                  <td><?=esc($row->disabled) ? '<div class="active-no"></div>' : '<div class="active-yes"></div>'?></td>
                  <td><?=esc($row->link)?></td>

                  <td style="display:flex;justify-content:center;align-items:center; gap:5px;">

                  <?php if(user_can('view_my_sliders')):?>
                  <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>/view/<?=$row->id?>">
                    <button class="btn btn-yellow text-light btn-sm" ><i class="fa-solid fa-eye"></i></button>
                  </a>
                  <?php endif ?>

                  <?php if(user_can('edit_my_slider')):?>
                  <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>/edit/<?=$row->id?>">
                    <button class="btn btn-blue text-light btn-sm" ><i class="fa-solid fa-pen"></i></button>
                  </a>
                  <?php endif ?>

                  <?php if(user_can('delete_my_slider')):?>
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
</div>
<?php else : ?>

<div class="alert alert-danger text-center">
  Access denied. You dont have permission for this action
</div>

<?php endif ?>

