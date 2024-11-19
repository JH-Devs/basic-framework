<?php if(user_can('view_footer_page')): ?>

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
            <!--  <th class="bg-body-tertiary " scope="col">
              <input type="checkbox" id="select_all" /> 
              </th>
              <th class="bg-body-tertiary " scope="col">Order</th> -->
              <th class="bg-body-tertiary " scope="col">Title</th>
              <!--
              <th class="bg-body-tertiary " scope="col">Image</th>  -->       
              <th class="bg-body-tertiary " scope="col">Active</th>
              <th class="bg-body-tertiary " scope="col">Slug</th>
              
              <th class="bg-body-tertiary " style="display:flex;justify-content:center;align-items:center;">

              <?php if(user_can('add_menu_page')):?>
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
               <!-- <td><input type="checkbox" name="selected_ids[]" value="<?=$row->id?>" /></td>
                  <td><?=$row->list_order?></td> -->
                  <td><?=esc($row->title)?></td>
                  <!--
                  <td>
                    <img src="<?=get_image($row->image)?>" class="img-thumbnail"  style="width:50px;height:50px;object-fit:cover;"/>
                  </td>
                -->
                  <td><?=esc($row->disabled) ? '<div class="active-no"></div>' : '<div class="active-yes"></div>'?></td>
                  <td><?=esc($row->slug)?></td>

                  <td style="display:flex;justify-content:center;align-items:center; gap:5px;">

                  <?php if(user_can('view_menu_page')):?>
                  <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>/view/<?=$row->id?>">
                    <button class="btn btn-yellow text-light btn-sm" ><i class="fa-solid fa-eye"></i></button>
                  </a>
                  <?php endif ?>

                  <?php if(user_can('edit_menu_page')):?>
                  <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>/edit/<?=$row->id?>">
                    <button class="btn btn-blue text-light btn-sm" ><i class="fa-solid fa-pen"></i></button>
                  </a>
                  <?php endif ?>

                  <?php if(user_can('delete_menu_page')):?>
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
    <div class="d-flex justify-content-between col-md-12">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select_all');
    const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');

    selectAllCheckbox.addEventListener('change', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });
});
</script>
