<?php
/**
 * Plugin name: 404 page not found
 * Author: JH-Devs
 * Description:
 */

/** displays the view file */
add_action('view', function() {

    $results = do_filter(plugin_id(). '_search_for_item', []);

    require plugin_path('views/view.php');
});
