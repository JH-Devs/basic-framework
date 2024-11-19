<?php

    $postdata = $req->post();
    $filedata = $req->files();

    $csrf = csrf_verify($postdata);

    $files_ok = true;
    if (!empty($filedata)) {
        $postdata['image'] = $req->upload_files('image');
        $postdata['mega_image'] = $req->upload_files('mega_image');
dd($postdata);
        if (!empty($req->upload_errors))
            $files_ok = false;
    }

    if($csrf && $files_ok && $menu->validate_insert($postdata)) {

        if (user_can('add_menu_page')) {

            $menu->insert($postdata);

            message_success("Record added successfully!");
            redirect($admin_route . '/' . $plugin_route);
        }

    } 
        
        if (!$csrf) 
            $menu->errors['email'] = "Form expired!";
        
        set_value('errors', $menu->errors);



