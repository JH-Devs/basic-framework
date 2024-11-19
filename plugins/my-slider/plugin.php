<?php
/**
 * Plugin name: My slider
 * Author: JH-Devs
 * Description:  A way for admin to manage slider
 */
set_value([
    'admin_route' =>'admin',
    'plugin_route' =>'my-sliders',
    'table' =>'my-slider',
]);


/** set footer page permissions for this plugin */
add_filter('permissions', function($permissions) {

    $permissions[] = 'view_my_sliders';
    $permissions[] = 'add_my_slider';
    $permissions[] = 'edit_my_slider';
    $permissions[] = 'delete_my_slider'; 
    return $permissions;
});

/** add to admin links */
add_filter('basic-admin_before_admin_links', function($links) {

    if(user_can('view_my_sliders')) {
        $vars = get_value();

        $obj = (object)[];
        $obj->title = 'My Sliders ';
        $obj->id = 'my-sliders';
        $obj->link = ROOT . '/' .$vars['admin_route'].'/'.$vars['plugin_route'];
        $obj->icon = 'fa-solid fa-image';
        $obj->parent = '0';
        $obj->list_order = 92; // Nastavení pozice (čím vyšší hodnota, tím nižší pozice v seznamu)

        $links[] = $obj;
    }

    // Seřadíme odkazy podle 'list_order' pokud existuje
    usort($links, function($a, $b) {
        return ($a->list_order ?? 0) <=> ($b->list_order ?? 0);
    });
    return $links;
});

/** run this after a form submit */
add_action('controller', function() {

    $req = new \Core\Request;
    $vars = get_value();

    $admin_route = $vars['admin_route'];
    $plugin_route = $vars['plugin_route'];

    $errors_route = $vars['errors'] ?? [];

    if (URL(1) == $vars['plugin_route'] && $req->posted()) {

        $ses = new \Core\Session;
        $my_slider = new \MySlider\MySlider;
        $slider_roles_map = new \MySlider\MySlider;

        $id = URL(3) ?? null;
        if ($id)
            $row = $my_slider->first(['id' => $id]);

        if (URL(2) == 'add') {
            
            require plugin_path('controllers/add-controller.php');
        } else
        if (URL(2) == 'edit') {
            
            require plugin_path('controllers/edit-controller.php');
        } else
        if (URL(2) == 'delete') {

            require plugin_path('controllers/delete-controller.php');
        } else 
        if (URL(2) == 'delete_all') {

            require plugin_path('controllers/delete-all-controller.php');
        } 
    }       
});
/** displays the slider **/
add_action('view',function(){

	if(page() == 'home')
	{
		$vars = get_value();

		$my_slider = new \MySlider\MySlider;
		$my_slider->order_column = 'id';
		$my_slider->order = 'asc';

		$rows = $my_slider->where(['disabled'=>0]);

		require plugin_path('views/frontend/my-slider.php');
	}
});

/** displays the view file */
add_action('basic-admin_main_content', function() {

    $ses = new \Core\Session;
    $vars = get_value();

    $admin_route = $vars['admin_route'];
    $plugin_route = $vars['plugin_route'];

    $my_slider = new \MySlider\MySlider;
    $all_items = $my_slider->query("select * from my_slider");
    
    if (URL(1) == $vars['plugin_route']) {

        $id = URL(3) ?? null;
        if ($id) {

            $my_slider::$query_id = 'get-my_slider';
            $row = $my_slider->first(['id' => $id]);

        }

        if (URL(2) == 'add') {
            
            require plugin_path('views/admin/add.php');
        } else
        if (URL(2) == 'edit') {
            
            require plugin_path('views/admin/edit.php');
        } else
        if (URL(2) == 'delete') {

            require plugin_path('views/admin/delete.php');
        } else
        if (URL(2) == 'view') {

            require plugin_path('views/admin/view.php');
        }  else {
				$rows = $my_slider->getAll();
			
            require plugin_path('views/admin/list.php');
        }

    } 
});
