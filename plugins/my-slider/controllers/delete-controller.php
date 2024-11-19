<?php
if (!empty($row)) {

    $postdata = $req->post();

    $csrf = csrf_verify($postdata);
    if ($csrf) {

        if (user_can('delete_my_slider')) {
            $image = new \Core\Image;
            $my_slider->delete($row->id);

            if (file_exists($row->image));
                unlink($row->image);

            if (file_exists($image->get_thumbnail($row->image)));
                unlink($image->get_thumbnail($row->image));


            message_success("Record deleted successfully!");
            redirect($admin_route . '/' . $plugin_route);
        }
    }
    $my_slider->errors['email'] = "Form expired!";

    set_value('errors', $my_slider->errors);
} else {
    message_fail("Record not found!");
}


