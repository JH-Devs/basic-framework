<?php if(user_can('view_posts')): ?>

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
         <!-- <th class="bg-body-tertiary " scope="col">
              <input type="checkbox" id="select_all" /> -->
              </th>
              <th class="bg-body-tertiary " scope="col">ID</th>
              <th class="bg-body-tertiary " scope="col">Title</th>
              <th class="bg-body-tertiary " scope="col">Author</th>
              <th class="bg-body-tertiary " scope="col">Image</th>
              <th class="bg-body-tertiary " scope="col">Slug</th> 
              <th class="bg-body-tertiary " scope="col">Categories</th> 
              <th class="bg-body-tertiary " scope="col">Views</th>    
              <th class="bg-body-tertiary " scope="col">Active</th>     
              <th class="bg-body-tertiary " scope="col">Created</th>  
              <th class="bg-body-tertiary " style="display:flex;justify-content:center;align-items:center;">

              <?php if(user_can('add_post')):?>
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
               <!-- <td><input type="checkbox" name="selected_ids[]" value="<?=$row->id?>" /></td> -->
                <td><?=$row->id?></td>
                    <td>
                      <a href="<?=ROOT?>/<?=$row->slug?>">
                      <?=esc($row->title)?>
                  </a>
                  </td>
                  <td>
                    <?php if(!empty($row->user_row)):?>
                      <a href="<?=ROOT?>/admin/users/view/<?=$row->user_row->id?>">
                        <?=$row->user_row->first_name?> 
                        <!--<?=$row->user_row->last_name?> -->
                      </a>
                    <?php else:?>	
                      <?='Unknown'?>
                    <?php endif?>	
                  </td>
                  <td>
                    <img src="<?=get_image($row->image)?>" class="img-thumbnail"  style="width:50px;height:50px;object-fit:cover;"/>
                  </td>
                  <td><?=esc($row->slug)?></td>
                  <td>
                    <?php if(!empty($row->category_rows)):?>
                      <?php foreach($row->category_rows as $cat):?>
                        <div><i><?=esc($cat->category)?></i></div>
                      <?php endforeach?>
                    <?php endif?>
                  </td>
                  <td><i class="fa-solid fa-eye"></i> <?=esc($row->views)?></td>
                  <td><?=esc($row->disabled) ? '<div class="active-no"></div>' : '<div class="active-yes"></div>'?></td>
                  
                  <td><?=get_date($row->date_created)?></td>
                  <td style="display:flex;justify-content:center;align-items:center; gap:5px;">

                  <?php if(user_can('view_user_details')):?>
                  <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>/view/<?=$row->id?>">
                    <button class="btn btn-yellow text-light btn-sm" ><i class="fa-solid fa-eye"></i></button>
                  </a>
                  <?php endif ?>

                  <?php if(user_can('edit_post')):?>
                  <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>/edit/<?=$row->id?>">
                    <button class="btn btn-blue text-light btn-sm" ><i class="fa-solid fa-user-pen"></i></button>
                  </a>
                  <?php endif ?>
                  <?php if(user_can('delete_post')):?>
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
      <!-- funkčnost tlačítka doplnit-->
      <div></div>
      
      <?=$pager->display()?>
  </div>

</div>
<?php else : ?>

<div class="alert alert-danger text-center">
  Access denied. You dont have permission for this action
</div>

<?php endif ?>

<script>
    document.getElementById('select_all').addEventListener('click', function(e) {
        const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = e.target.checked;
        });
    });
</script>
