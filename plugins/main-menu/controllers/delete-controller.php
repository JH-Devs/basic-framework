<?php
if (!empty($row)) {

    $postdata = $req->post();

    $csrf = csrf_verify($postdata);
    if ($csrf) {

        if (user_can('delete_menu_page')) {
            $image = new \Core\Image;
            $menu->delete($row->id);

            if (file_exists($row->image));
                unlink($row->image);


            if (file_exists($row->mega_image));
                unlink($row->mega_image);

            if (file_exists($image->get_thumbnail($row->image)));
                unlink($image->get_thumbnail($row->image));

            if (file_exists($image->get_thumbnail($row->mega_image)));
                unlink($image->get_thumbnail($row->mega_image));

            message_success("Record deleted successfully!");
            redirect($admin_route . '/' . $plugin_route);
        }
    }
    $menu->errors['email'] = "Form expired!";

    set_value('errors', $menu->errors);
} else {
    message_fail("Record not found!");
}


