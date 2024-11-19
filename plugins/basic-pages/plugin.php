<?php
/**
 * Plugin name: Basic Pages
 * Author: JH-Devs
 * Description:  Creates pages for your website
 */
set_value([
    'admin_route' =>'admin',
    'plugin_route' =>'pages',
    'tables' =>[
        'pages_table' => 'pages',
        'categories_table' => 'categories',
    ],
]);
 /** check if al tables exist */
 $db = new \Core\Database;

 $tables = get_value()['tables'];
 
if (!$db->table_exists($tables)) {
   dd("Missing database tables in ".plugin_id()." plugin: " . implode(",", $db->missing_tables) ); 
}

/** set user permissions for this plugin */
add_action('permissions', function($permissions) {

    $permissions[] = 'view_pages';
    $permissions[] = 'add_page';
    $permissions[] = 'edit_page';
    $permissions[] = 'delete_page';
    return $permissions;
});
/** add to admin links */
add_filter('basic-admin_before_admin_links', function($links) {

    if(user_can('view_pages')) {
        $vars = get_value();

        $obj = (object)[];
        $obj->title = 'Pages';
        $obj->id = 'pages';
        $obj->link = ROOT . '/' .$vars['admin_route'].'/'.$vars['plugin_route'];
        $obj->icon = 'fa-solid fa-copy';
        $obj->parent = '0';
        $obj->list_order = 91; // Nastavení pozice (čím vyšší hodnota, tím nižší pozice v seznamu)

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

    if (page() == $vars['admin_route'] && URL(1) == $vars['plugin_route'] && $req->posted()) {

        $ses = new \Core\Session;
        $page = new \BasicPages\Page;

        $id = URL(3) ?? null;
        if ($id)
            $row = $page->first(['id' => $id]);

        if (URL(2) == 'add') {
            
            require plugin_path('controllers/add-controller.php');
        } else
        if (URL(2) == 'edit') {
            
            require plugin_path('controllers/edit-controller.php');
        } else
        if (URL(2) == 'delete') {

            require plugin_path('controllers/delete-controller.php');
        }
    }       
});

/** displays the admin view file */
add_action('basic-admin_main_content', function() {

    $ses = new \Core\Session;
    $vars = get_value();

    $admin_route = $vars['admin_route'];
    $plugin_route = $vars['plugin_route'];

    $page = new \BasicPages\Page;
    $categories_map = new \BasicPages\Categories_map;
    
    if(page() == $vars['admin_route'] && URL(1) == $vars['plugin_route']) {

        $id = URL(3) ?? null;
        if ($id) {

            $page::$query_id = 'get-pages';
            $row = $page->first(['id' => $id]);

            $content = new \BasicPages\Content;
			$row->content = $content->add_root($row->content);

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
        } else {
            $limit = 30;
            $pager = new \Core\Pager($limit,1);
            $offset = $pager->offset;

            $page->limit = $limit;
            $page->offset = $offset;
            
            $page::$query_id = 'get-pages';

            if(!empty($_GET['find'])) {
                $find = '%' . trim($_GET['find']) . '%';
                $pages_table = $tables = $vars['tables']['pages_table'];

                $query = "select * from pages where (title like :find ) limit $limit offset $offset";
                $rows = $page->query($query,['find'=>$find]);
            } else {
                $rows = $page->getAll();
            }
            
            require plugin_path('views/admin/list.php');
        }

    } 
});

/** displays the frontend view file */
add_action('view', function() {

    $vars = get_value();
    $page = new \BasicPages\Page;

    $page::$query_id = 'get-pages';
    $row = $page->first(['slug'=>page()]);
    if($row) {
        
         // Pokud je stránka zakázaná (disabled), nezobrazíme ji
         if ($row->disabled == '1') {

            return; // Ukončení zpracování, pokud je stránka zakázaná
        }

        $content = new \BasicPages\Content;
		$row->content = $content->add_root($row->content);

        require plugin_path('views/frontend/view.php');
    }
});

/** for manipulating data after a query operation **/
add_filter('after_query',function($data){

	$categories_map = new \BasicPages\Categories_map;

	if(empty($data['result']))
		return $data;

	if($data['query_id'] == 'get-pages')
	{
		$db = new \Core\Database;
		foreach ($data['result'] as $key => $row) {
			
			$user_row = $db->get_row("select * from users where id = :id limit 1",['id'=>$row->user_id]);
			if($user_row)
				$data['result'][$key]->user_row = $user_row;

			$category_rows = $categories_map->get_category_rows($row->id);
			if($category_rows)
				$data['result'][$key]->category_rows = $category_rows;

		}
	}

	return $data;
});

