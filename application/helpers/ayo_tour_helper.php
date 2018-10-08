<?php

function is_logged_in()
{
    $CI =& get_instance();
    $is_logged = $CI->session->userdata('ayo_tour_logged_in');
    if (isset($is_logged) && $is_logged === TRUE) {
        return TRUE;
    } else {
        redirect(site_url('at-admin/auth'));
    }
}

?>