<?php

function get_product_by_id($id) {
    $result = db_fetch_row("SELECT * FROM `tbl_product` WHERE `id` = {$id}");
    // $result['url_detail'] = "?mod=products&action=detail&id={$result['id']}";
    if (!empty($result))
        return $result;

    return false;
}

function get_user_id($user_login) {
    $result = db_fetch_row("SELECT `id` FROM `tbl_user` WHERE `username` = '{$user_login}'");
    if (!empty($result))
        return $result['id'];

    return false;
}

function add_transaction($data) {
    db_insert("tbl_transaction", $data);
}

function add_order($data) {
    db_insert("tbl_order", $data);
}
