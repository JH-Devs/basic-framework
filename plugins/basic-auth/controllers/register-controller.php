<?php

 $user = new \BasicAuth\User;

 if($csrf = csrf_verify($req->post()) && $user->validate_insert($req->post()))
 {
     $postdata = $req->post();
     $postdata['date_created'] = date("Y-m-d H:i:s");
     $postdata['password'] = password_hash($postdata['password'], PASSWORD_DEFAULT);

     $user->insert($postdata);

     message_success("Register complete! Please login to continue");
     redirect($vars['login_page']);
 }else
 {
    if (!$csrf)
        $user->errors['email'] = "Form expired! Please refresh.";
     set_value('errors',$user->errors);
 }