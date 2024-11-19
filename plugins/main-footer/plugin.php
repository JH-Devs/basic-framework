<?php
/**
 * Plugin name: Main Footer
 * Author: JH-Devs
 * Description:  A way for admin to manage footer
 */
set_value([
    'admin_route' =>'admin',
    'plugin_route' =>'main-footer',
    'tables' =>[
        'footer_table' => 'footer',
    ],
]);

 /** check if al tables exist */
 $db = new \Core\Database;

 $tables = get_value()['tables'];
 
if (!$db->table_exists($tables)) {
   dd("Missing database tables in ".plugin_id()." plugin: " . implode(",", $db->missing_tables) ); 
}


/** set footer page permissions for this plugin */
add_filter('permissions', function($permissions) {

    $permissions[] = 'view_footer_page';
    $permissions[] = 'add_footer_page';
    $permissions[] = 'edit_footer_page';
    $permissions[] = 'delete_footer_page'; 
    return $permissions;
});

/** add to footer links */
add_action('header-footer_main_footer', function($data) {

    $image = new \Core\Image;
    $links = $data['links'];

    // Pokud $links obsahuje data, provede se renderování
    if (!empty($links)) {
        require plugin_path('views/frontend/footer.php');
    } 
});

/** add to admin links */
add_filter('basic-admin_before_admin_links', function($links) {

    if(user_can('view_footer_pages')) {
        $vars = get_value();

        $obj = (object)[];
        $obj->title = 'Footer ';
        $obj->id = 'main-footer';
        $obj->link = ROOT . '/' .$vars['admin_route'].'/'.$vars['plugin_route'];
        $obj->icon = 'fa-solid fa-shoe-prints';
        $obj->parent = '0';
        $obj->list_order = 100; // Nastavení pozice (čím vyšší hodnota, tím nižší pozice v seznamu)

        $links[] = $obj;
    }

    // Seřadíme odkazy podle 'list_order' pokud existuje
    usort($links, function($a, $b) {
        return ($a->list_order ?? 0) <=> ($b->list_order ?? 0);
    });
    return $links;
});

/** add footer links */
add_filter('header-footer_after_footer_links', function($links) {

    $vars = get_value();
    $footer = new \MainFooter\Footer;

    $footer->order = 'asc';	
    $footer->order_column = 'list_order';	
    $footer::$query_id = 'get-footer-with-children';
    $rows = $footer->where(['disabled'=>0, 'parent'=>0]);
    
    $links = empty($links) ? [] : $links;
    $links = array_merge($links,$rows);

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
        $footer = new \MainFooter\Footer;
        $footer_roles_map = new \MainFooter\Footer;

        $id = URL(3) ?? null;
        if ($id)
            $row = $footer->first(['id' => $id]);

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

/** displays the view file */
add_action('basic-admin_main_content', function() {

    $ses = new \Core\Session;
    $vars = get_value();

    $admin_route = $vars['admin_route'];
    $plugin_route = $vars['plugin_route'];

    $footer = new \MainFooter\Footer;
    $all_items = $footer->query("select * from footer");
    
    if (URL(1) == $vars['plugin_route']) {

        $id = URL(3) ?? null;
        if ($id) {

            $footer::$query_id = 'get-footer';
            $row = $footer->first(['id' => $id]);

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
            $limit = 30;
            $pager = new \Core\Pager($limit,1);
            $offset = $pager->offset;

            /** řazení vzestupně */
            $footer->order = 'asc';
            $footer->order_column = 'list_order';

            $footer->limit = $limit;
            $footer->offset = $offset; 
            
            $footer::$query_id = 'get-footer';

            if(!empty($_GET['find']))
			{
				$find = '%' . trim($_GET['find']) . '%';
				$query = "select * from footer where title like :find limit $limit offset $offset";
				$rows = $footer->query($query,['find'=>$find]);
			}else{
				$rows = $footer->getAll();
			}
            
            require plugin_path('views/admin/list.php');
        }

    } 
});

/** for manipulating data after a query operation */
add_filter('after_query',function($data){

	
	if(empty($data['result']))
		return $data;

	if(false && $data['query_id'] == 'get-footer')
	{
		$role_map = new \MainFooter\Footer;
		foreach ($data['result'] as $key => $row) {
			
			$query = "select * from user_roles where disabled = 0 && id in (select role_id from user_roles_map where disabled = 0 && user_id = :user_id)";
            
			$roles = $role_map->query($query,['user_id'=>$row->id]);
			if($roles)
				$data['result'][$key]->roles = array_column($roles, 'role');
			
			/** get user's roles */
			$footer_roles_map = new \MainFooter\Footer;
				
			$role_ids = $footer_roles_map->where(['user_id'=>$row->id,'disabled'=>0]);
			if($role_ids)
				$data['result'][$key]->role_ids = array_column($role_ids, 'role_id');

		}
	} else
    /** dropdown sub footer*/
    if($data['query_id'] == 'get-footer-with-children')
	{
		$footer = new \MainFooter\Footer;
		foreach ($data['result'] as $key => $row) {
            
            $footer->order = 'asc';	
			$footer->order_column = 'list_order';	
			$children = $footer->where(['parent'=>$row->id,'disabled'=>0]);
			if($children) {
				$data['result'][$key]->children = $children;

                foreach ($children as $ikey => $irow) {
                    $grandchildren = $footer->where(['parent'=>$irow->id,'disabled'=>0]);
                    if($grandchildren)
                    $data['result'][$key]->children[$ikey]->grandchildren = $grandchildren;
                        
                }
            }
		}
	}

	return $data;
});