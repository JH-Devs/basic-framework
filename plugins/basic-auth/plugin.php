<?php
/**
 * Plugin name: Basic  Authentication
 * Author: JH-Devs
 * Description:  Lets users login and register
 */
set_value([
    'login_page' =>'login',
    'register_page' =>'register',
    'forgot_page' =>'forgot',
    'logout_page' =>'logout',
    'admin_plugin_route' =>'admin',
    'tables' => [
        'users_table' => 'users'
    ],
    'optional_tables' =>[
        'roles_table' => 'user_roles',
        'permissions_table' => 'role_permissions',
        'roles_map_table' => 'user_roles_map',
    ],
]);
 /** check if al tables exist */
 $db = new \Core\Database;

 $tables = get_value()['tables'];
 
if (!$db->table_exists($tables)) {
    dd("Missing database tables in ".plugin_id()." plugin: " . implode(",", $tables) ); die;
}

/** run this after a form submit */
add_action('controller', function() {

    $vars = get_value();
    $req = new \Core\Request;
    $ses = new \Core\Session;

    if ($req->posted() && page() == $vars['login_page'])
        require plugin_path('controllers/login-controller.php');
    else
    if ($req->posted() && page() == $vars['register_page'])
        require plugin_path('controllers/register-controller.php');

    else
    if (page() == $vars['logout_page'])
        require plugin_path('controllers/logout-controller.php');
});


/** set permissions for current user */
add_filter('user_permissions', function($permissions) {

    $ses = new \Core\Session;

if($ses->is_logged_in()) {

    $vars = get_value();

    $db = new \Core\Database;
    
    $query = "select * from " . $vars['optional_tables']['roles_table'];
    $roles = $db->query($query);

    if (is_array($roles)) {

        $user_id = $ses->user('id');
        $query = "select permission from " .$vars['optional_tables']['permissions_table']. "
        where disabled = 0 && role_id in
        (select role_id from " .$vars['optional_tables']['roles_map_table']. " where disabled = 0 && user_id = :user_id)";

        $perms = $db->query($query,['user_id'=>$user_id]);

        if ($perms)
            $permissions = array_column($perms,'permission');
    } else {
        $permissions[] = 'all';
    }
}
return $permissions;
});

/** add menu links */
add_filter('header-footer_before_menu_links', function($links) {
    $ses = new \Core\Session;
    $vars = get_value();

    // Remove the login link from the menu, but keep the functionality intact
    if (!$ses->is_logged_in()) {
        // Uncomment the following if you want to hide the register link as well
        /*
        $link = (object)[];
        $link->id = 0;
        $link->title = 'Register';
        $link->slug = 'register';
        $link->icon = '';
        $link->permission = 'not_logged_in';
        $links[] = $link;
        */
    }

    $link = (object)[];
    $link->id = 0;
    $link->title = $ses->user('first_name');
    $link->slug = '#';
    $link->icon = '';
    $link->image = $ses->user('image');
    $link->show_image = 1;
    $link->list_order = 20;
    $link->permission = 'logged_in';
    $link->children = [];

    $link2 = (object)[];
    $link2->id = 0;
    $link2->title = 'Profile';
    $link2->slug = 'profile/'.$ses->user('id');
    $link2->icon = '';
    $link2->permission = 'logged_in';
    $link->children[] = $link2;

    if ($ses->is_logged_in() && user_can('is_admin')) {
        $link2 = (object)[];
        $link2->id = 0;
        $link2->title = 'Admin';
        $link2->slug = $vars['admin_plugin_route'];
        $link2->icon = '';
        $link2->permission = 'logged_in';
        $link->children[] = $link2;
    }

    $link2 = (object)[];
    $link2->id = 0;
    $link2->title = 'Logout';
    $link2->slug = 'logout';
    $link2->icon = 'fa-solid fa-right-from-bracket';
    $link2->permission = 'logged_in';
    $link->children[] = $link2;

    $links[] = $link;

    return $links;
});

/** displays the view file */
add_action('view', function() {

    $vars = get_value();
    if (page() == $vars['login_page']) {
        require plugin_path('views/login.php');
    } /*
    else 
    if (page() == $vars['register_page']) {
        $errors = $vars['errors'] ?? [];
        require plugin_path('views/register.php');
    } */
});
/** for manipulating data after a query operation */
add_filter('after_query', function($data) {

    if(empty($data['result']))
        return $data;

    foreach ($data['result'] as $key => $row) {

    }

    return $data;
});