<?php
/**
 * Plugin name: Header and footer
 * Author: JH-Devs
 * Description: Plugin Created for thuder php
 */

/** displays the view file */
add_action('before_view', function() {

    $links = [];

    $link        = (object)[];
    $link->id    = 0;
    $link->title = '<i class="fa-solid fa-house"></i>';
    $link->slug  = '';
    $link->icon  = '';
    $link->list_order = 1;
    $link->permission  = '';
    $links[] = $link;

    $links = do_filter(plugin_id(). '_before_menu_links', $links);

    require plugin_path('views/header.php');
});

add_action('after_view', function() {
    // Sociální odkazy
    $links = [];
    $links = do_filter(plugin_id(). '_after_social_links',$links);
    require plugin_path('views/footer-social.php');

    // Hlavní odkazy
    $links = [];
    $links = do_filter(plugin_id(). '_after_footer_links', $links);
    // Předání proměnných do šablony
    require plugin_path('views/footer.php');

    
 

});

