<?php

if(!empty($row)) {
	$postdata = $req->post();
	$filedata = $req->files();
	$postdata['id'] = $row->id;

	$csrf = csrf_verify($postdata);

	$files_ok = true;
	if(!empty($filedata)){

		$req->upload_folder = plugin_path('uploads');

		$postdata['image'] = $req->upload_files('image');

		if(!empty($req->upload_errors))
			$files_ok = false;
	}

	if($csrf && $files_ok && $my_slider->validate_update($postdata)) {
		if(user_can('edit_my_slider')) {
 			$image = new \Core\Image;
			unset($postdata['id']);

			if(empty($postdata['image']))
				unset($postdata['image']);
			
				if(!empty($postdata['remove_image'])) 
					$postdata['image'] = "";


			$my_slider->update($row->id,$postdata);

			if(!empty($postdata['image']) && file_exists($row->image)) {
				unlink($image->get_thumbnail($row->image));
				unlink($row->image);
			}
 			
			message_success("Record edited successfully!");
			redirect($admin_route.'/'.$plugin_route.'/view/'.$row->id);
		}
	}

	if(!$csrf)
		$my_slider->errors['email'] = "Form expired!";

	set_value('errors',array_merge($my_slider->errors,$req->upload_errors));
}else{

	message_fail("Record not found");
}
