<?php

    $postdata = $req->post();
    $filedata = $req->files();

    $csrf = csrf_verify($postdata);

    $files_ok = true;
    if (!empty($filedata)) {
        $postdata['image'] = $req->upload_files('image');
        
dd($postdata);
        if (!empty($req->upload_errors))
            $files_ok = false;
    }

    if($csrf && $files_ok && $footer->validate_insert($postdata)) {

        if (user_can('add_footer_page')) {

            $footer->insert($postdata);

            message_success("Record added successfully!");
            redirect($admin_route . '/' . $plugin_route);
        }

    } 
        
        if (!$csrf) 
            $footer->errors['email'] = "Form expired!";
        
        set_value('errors', $footer->errors);



