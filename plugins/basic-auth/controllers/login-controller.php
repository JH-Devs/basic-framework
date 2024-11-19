<?php

 $user = new \BasicAuth\User;

 if($csrf = csrf_verify($req->post()))
 {
    $postdata = $req->post();
    $row = $user->first(['email' => $postdata['email']]);
   
    if($row) {
        if (password_verify($postdata['password'], $row->password)) {
            $ses->auth($row);
            redirect('admin'); // Routing depends on whether it's only for the administration or if users will also be logging in. If users are logging in, the route should point to the home. If it's only for the admin without user logins, the routing remains as admin.
        }
       
    }

    message_fail('Wrong email or password');
 }else
 {
    message_fail( 'Form expired! Please refresh.');
 }