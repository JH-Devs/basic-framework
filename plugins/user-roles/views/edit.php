<?php if(user_can('edit_role')):?>

	<?php if(!empty($row)):?>

			<form onsubmit="submit_form(event)" method="post" enctype="multipart/form-data">
				
				<div class="row g-3 col-md-6 mx-auto shadow p-4 rounded mt-3">
				
				<?=csrf()?>

				<h4 class="">Edit Record</h4>
 
				<div class="mb-3 col-md-6">
				  <label for="role" class="form-label">Role</label>
				  <input name="role" value="<?=old_value('role',$row->role)?>" type="text" class="form-control" id="role" placeholder="Role Title e.g admin">
					
					<?php if(!empty($errors['role'])):?>
					  <small class="text-danger"><?=$errors['role']?></small>
					<?php endif?>
				</div>

				<div class="mb-3 col-md-6">
					<label for="email" class="form-label">Active</label>
					<select class="form-select" name="disabled">
					  <option value="">--Select Status--</option>
					  <option <?=old_select('disabled','0',$row->disabled)?> value="0">Yes</option>
					  <option <?=old_select('disabled','1',$row->disabled)?> value="1">No</option>
					</select>

				</div>
 
				<div class="d-flex justify-content-between">
					<a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>">
						<button type="button" class="btn btn-secondary">
							<i class="fa-solid fa-chevron-left"></i> Back
						</button>
					</a>
					<button class="btn btn-lime text-light">
						<i class="fa-solid fa-save"></i> Save
					</button>
				</div>
			</div>
		</form>
		<script type="text/javascript">

			var valid_image = true;
			function display_image(e)
			{
				let allowed = ['image/jpeg','image/png','image/webp'];
				let file = e.currentTarget.files[0];

				if(!allowed.includes(file.type)){
					alert("Only files of this type allowed: " + allowed.toString().replaceAll('image/',''));
					valid_image = false;
					return;
				}
				valid_image = true;
				e.currentTarget.parentNode.querySelector('img').src = URL.createObjectURL(file);
			}

			function submit_form(e)
			{
				if(!valid_image)
				{
					e.preventDefault()
					alert("Please add a valid image");
					return;
				}
			}

		</script>
	<?php else:?>
		<div class="alert alert-danger text-center">
			That record was not found!
		</div>
		
		<a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>">
			<button class="btn btn-primary">Back</button>
		</a>
	<?php endif?>

<?php else:?>
	<div class="alert alert-danger text-center">
		Access denied. You dont have permission for this action
	</div>
<?php endif?>