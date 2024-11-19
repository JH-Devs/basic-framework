<?php
/**
 * Plugin name: Basic Admin
 * Author: JH-Devs
 * Description:  Provides a basic admin area 
 */
set_value([
    'plugin_route' =>'admin',
    'logout_page' =>'logout',
    'setting_page' => 'setting',
]);
/** set user permissions for this plugin */
add_filter('permissions', function($permissions) {

    $permissions[] = 'view_admin_page';
    return $permissions;
});
/** run this after a form submit */
add_action('before_controller', function() {

    $vars = get_value();

   if(page() == $vars['plugin_route'] && !user_can('view_admin_page')) {
        message_fail("Access to admin page denied! Please try a different login");
        redirect('login');
   }
});
/** run this after a form submit */
add_action('controller', function() {

    do_action(plugin_id() . '_controller');
});

/** displays the view file */
add_action('view', function() {

    $vars = get_value();

    $section_title = ucfirst(str_replace("-", " ", (URL(1) ?? '')));
    $section_id = strtolower(str_replace("-", "_", (URL(1) ?? '')));
    
    // Pokud není žádný segment v URL, nastavíme výchozí hodnoty
    if (empty(URL(1))) {
        $section_title = "Dashboard";
        $section_id = "dashboard";

        $section_title = do_filter(plugin_id().'_before_section_title', $section_title);
    }
    
    $ses = new \Core\Session;
    $current_page = basename($_SERVER['REQUEST_URI']);

    $links = [];
  
    if ($ses->is_logged_in() && user_can('is_admin')){

        $obj = (object)[];
        $obj->title = 'Dashboard';
        $obj->id = 'dashboard';
        $obj->link = ROOT . '/' .$vars['plugin_route'];
        $obj->icon = 'fa-solid fa-house';
        $obj->parent = '0';
        $links[] = $obj;

    }

    $links = do_filter(plugin_id().'_before_admin_links', $links);


    $bottom_links = [];


        $obj        = (object)[];
        $obj->id    = 0;
        $obj->title = '<span class="text-cyan">User: '. $ses->user('first_name') . '</span>';
        $obj->link = $vars['plugin_route'].'/'.('profile/'.$ses->user('id'));
        $obj->icon  = 'fa-solid fa-user';
        $obj->permission  = 'logged_in';
        $bottom_links[] = $obj;

        $obj = (object)[];
        $obj->title = 'Website home';
        $obj->id = 'website_home';
        $obj->link = ROOT;
        $obj->icon = 'fa-solid fa-globe';
        $obj->parent = '0';

        $bottom_links[] = $obj;

/*    if ($ses->is_logged_in() && user_can('is_admin')){
        $obj = (object)[];
        $obj->title = 'Settings';
        $obj->id = 'settings';
        $obj->link = ROOT . '/' .$vars['setting_page'];
        $obj->icon = 'fa-solid fa-gear';
        $obj->parent = '0';

        $bottom_links[] = $obj;
    } */
        $obj = (object)[];
        $obj->title = 'Logout';
        $obj->id = 'sign_out';
        $obj->link = ROOT . '/' . $vars['logout_page'];
        $obj->icon = 'fa-solid fa-right-from-bracket';
        $obj->parent = '0';

        $bottom_links[] = $obj;


    require plugin_path('views/view.php');
});

