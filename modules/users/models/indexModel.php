<?php

# Function for user

function add_user($data){
    return db_insert('tbl_user', $data);
}

function user_exists($username, $email){
    $check_user = db_num_rows("SELECT * FROM tbl_user WHERE username = '{$username}' OR email = '{$email}'");
    if($check_user > 0){
        return true;
    }
    return false;
}

function get_list_users(){
    $result = db_fetch_array("SELECT * FROM `tbl_user`");
    foreach($result as &$user){
        $user['url_update'] = "?mod=users&controller=index&action=update&id={$user['user_id']}";
        $user['url_delete'] = "?mod=users&controller=index&action=delete&id={$user['user_id']}";
    }
    return $result;
}

function get_user_info($user_login){
    $result = db_fetch_row("SELECT * FROM `tbl_user` WHERE `username` = '{$user_login}'");
    if(!empty($result)) return $result;

    return false;
}

function update_user_info($data, $username){
    db_update("tbl_user", $data, "`username` = '{$username}'");
}

# Function for control the User panel

function check_login($username,$password){
    $password = md5($password);
    $check_user = db_num_rows("SELECT * FROM `tbl_user` WHERE `username` = '{$username} ' AND `password` = '{$password}' AND `is_active` = '1'");
    if($check_user == 1) return true;
    
    return false;
}

function check_token($active_token){
    $check_token = db_num_rows("SELECT * FROM `tbl_user` WHERE `active_token` = '$active_token'");
    if($check_token === 1){
        return true;
    }
    return false;
}

function active_user($active_token){
    $data['is_active'] = 1;
    $where = "`active_token` = '{$active_token}' AND `is_active` = '0'";
    return db_update('tbl_user', $data, $where);
}

//kiem tra email voi pass co dung voi da tao khog neu dung ==1 sai tra ve false
function check_email($email){
    $result = db_num_rows("SELECT * FROM `tbl_user` WHERE `email` = '{$email}'");
    if($result == 1){
        return true;
    }
    return false;
}

function update_reset_token($data, $email){
    db_update('tbl_user', $data , "`email` = '{$email}'");
}

function check_reset_token($reset_token){
    $result = db_num_rows("SELECT * FROM `tbl_user` WHERE `reset_token` = '{$reset_token}'");
    if($result == 1){
        return true;
    }
    return false;
}

function update_pass($data, $reset_token){
    db_update('tbl_user', $data , "`reset_token` = '{$reset_token}'");
}

# Function Global for All

function get_num_rows($table, $where = '') {
    if (empty($where)) {
        $result = db_num_rows("SELECT * FROM `{$table}`");
        return $result;
    } else {
        $result = db_num_rows("SELECT * FROM `{$table}` WHERE {$where}");
        return $result;
    }
}

function get_url_upload_image($id) {
    $result = db_fetch_row("SELECT * FROM `tbl_page` WHERE `id` = {$id}");
    return $result['page_thumbnail'];
}

function is_exists($table, $key, $value) {
    $check = db_num_rows("SELECT * FROM `{$table}` WHERE `{$key}` = '{$value}'");
    if ($check > 0) return true;
    
    return false;
}

function search_item($table, $search_by = '', $s, $start, $num_per_page) {

    if (!empty($s)) {
        $result = db_fetch_array("SELECT * FROM `{$table}` WHERE {$search_by} LIKE '%{$s}%' LIMIT {$start} , {$num_per_page}");
        if (!empty($result)) {
            foreach ($result as &$item) {
                switch ($item['tracking']) {
                    case 1 : $item['tracking'] = "Stocking";
                        $item['tracking_css'] = 1;
                        break;
                    case 2 : $item['tracking'] = "Out of Stock";
                        $item['tracking_css'] = 2;
                        break;
                    case 3 : $item['tracking'] = "Temporary Out";
                        $item['tracking_css'] = 3;
                        break;
                    case 4 : $item['tracking'] = "Importing goods";
                        $item['tracking_css'] = 4;
                        break;
                    default : $item['tracking'] = "Checking";
                }
                switch ($item['status']) {
                    case 0 : $item['status'] = "Waiting";
                        $item['status_css'] = 0;
                        break;
                    case 1 : $item['status'] = "Approved";
                        $item['status_css'] = 1;
                        break;
                    case 2 : $item['status'] = "Trash";
                        $item['status_css'] = 2;
                        break;
                }
                switch ($item['cat_id']) {
                    case 1 : $item['cat_title'] = "?i�?n thoa?i";
                        break;
                    case 2 : $item['cat_title'] = "Ma?y ti?nh ba?ng";
                        break;
                    case 3 : $item['cat_title'] = "Laptop";
                        break;
                    case 4 : $item['cat_title'] = "Tai nghe";
                        break;
                    case 5 : $item['cat_title'] = "Th??i trang";
                        break;
                    case 6 : $item['cat_title'] = "?�? gia du?ng";
                        break;
                    case 7 : $item['cat_title'] = "Thi�?t bi? v?n pho?ng";
                        break;
                    default : $item['cat_title'] = "None";
                }

                $item['url_edit'] = "?mod=products&controller=index&action=editProduct&id={$item['id']}";
                $item['url_move_trash'] = "?mod=products&controller=index&action=moveTrash&id={$item['id']}";
                $item['status_css'] = set_css_by_status($item['status_css']);
                $item['tracking_css'] = set_css_by_tracking($item['tracking_css']);
                $item['url_approve'] = "?mod=products&controller=index&action=approveProduct&id={$item['id']}";
            }
            return $result;
        }
    }

    return false;
}

