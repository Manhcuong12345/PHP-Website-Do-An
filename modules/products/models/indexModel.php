<?php

# Function for Category

function get_list_cat() {
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat`");
    if (is_array($result)) {
        foreach ($result as &$item) {
            $item['url_product'] = "?mod=products&action=showListProduct&cat_id={$item['cat_id']}";
        }
        return $result;
    }
    return false;
}

function get_info_cat($cat_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_product_cat` WHERE `cat_id`= {$cat_id}");
    $result['url_cat'] = "?mod=products&action=showListProduct&cat_id={$result['cat_id']}";
    return $result;
}

# Function for Product

function get_list_product($cat_id, $start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` = {$cat_id} AND `status` = '1' LIMIT {$start}, {$num_per_page}");

    if (!empty($result)) {
        foreach ($result as &$item) {
            $item['product_url'] = "?mod=products&action=detail&id={$item['id']}";
            $item['url_checkout'] = "?mod=cart&action=checkout&id={$item['id']}";
            $item['url_add_cart'] = "?mod=cart&action=addCart&id={$item['id']}";
        }
        return $result;
    }
    return false;
}

function get_product($product_id = '', $slug = '') {
    if (!empty($slug)) {
        $result = db_fetch_row("SELECT * FROM `tbl_product` WHERE `slug` = '{$slug}'");
        if (!empty($result)) {
            $result['url_add_cart'] = "?mod=cart&action=addCart&name={$result['slug']}";
            $result['tracking'] = convert_tracking_to_string($result['tracking']);

            return $result;
        }
        return false;
    } elseif (!empty($product_id)) {
        $result = db_fetch_row("SELECT * FROM `tbl_product` WHERE `id` = {$product_id}");
        if (!empty($result)) {
            $result['url_add_cart'] = "?mod=cart&action=addCart&name={$result['id']}";
            $result['tracking'] = convert_tracking_to_string($result['tracking']);

            return $result;
        }
        return false;
    }
}

function get_list_same_category_product($cat_id, $current_product_id) {
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` = {$cat_id} AND `id` != '{$current_product_id}' AND `status` = '1'");
    if (!empty($result)) {
        foreach ($result as &$item) {
            $item['url_detail'] = "?mod=products&action=detail&id={$item['id']}";
            $item['url_add_cart'] = "?mod=cart&action=addCart&id={$item['id']}";
            $item['url_checkout'] = "?mod=cart&action=buyNow&id={$item['id']}";
        }
        return $result;
    }

    return false;
}

# Function for Slider Product

function get_slider_thumbnail_by_product_code($product_code) {
    $slider = db_fetch_row("SELECT * FROM `tbl_slider` WHERE `product_code` = '{$product_code}' AND `status` = '1'");
    if (!empty($slider)) {
        $slider_thumbnail = db_fetch_array("SELECT * FROM `tbl_slider_thumbnail` WHERE `slider_code` = '{$slider['slider_code']}'");
        if (!empty($slider_thumbnail))
            return $slider_thumbnail;
    }

    return false;
}

# Function for Filter

function get_list_product_by_filter($cat_id, $r_price) {
    switch ($r_price) {
        case 1 : $str = "`status` = '1' AND `cat_id` = '{$cat_id}' AND `price` < 500000";
            break;
        case 2 : $str = "`status` = '1' AND `cat_id` = '{$cat_id}' AND `price` > 500000 AND `price` <= 1000000";
            break;
        case 3 : $str = "`status` = '1' AND `cat_id` = '{$cat_id}' AND `price` > 1000000 AND `price` <= 5000000";
            break;
        case 4 : $str = "`status` = '1' AND `cat_id` = '{$cat_id}' AND `price` > 5000000 AND `price` <= 10000000";
            break;
        case 5 : $str = "`status` = '1' AND `cat_id` = '{$cat_id}' AND `price` > 10000000";
            break;
    }

    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE $str");
    if (!empty($result)) {
        foreach ($result as &$item) {
            $item['url_add_cart'] = "?mod=cart&action=addCart&id={$item['id']}";
            $item['url_checkout'] = "?mod=cart&action=checkout";
            $item['product_url'] = "?mod=products&action=detail&id={$item['id']}";
        }
        return $result;
    }

    return false;
}

;

function get_list_product_by_sort($cat_id, $sort_by) {
    switch ($sort_by) {
        case 1 : $str = "`title` ASC";
            break;
        case 2 : $str = "`title` DESC";
            break;
        case 3 : $str = "`price` DESC";
            break;
        case 4 : $str = "`price` ASC";
            break;
    }

    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` = '{$cat_id}' ORDER BY {$str}");
    if (!empty($result)) {
        foreach ($result as &$item) {
            $item['url_add_cart'] = "?mod=cart&action=addCart&id={$item['id']}";
            $item['url_checkout'] = "?mod=cart&action=checkout";
            $item['product_url'] = "?mod=products&action=detail&id={$item['id']}";
        }
        return $result;
    }

    return false;
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
                    case 1 : $item['cat_title'] = "?ię?n thoa?i";
                        break;
                    case 2 : $item['cat_title'] = "Ma?y ti?nh ba?ng";
                        break;
                    case 3 : $item['cat_title'] = "Laptop";
                        break;
                    case 4 : $item['cat_title'] = "Tai nghe";
                        break;
                    case 5 : $item['cat_title'] = "Th??i trang";
                        break;
                    case 6 : $item['cat_title'] = "?ô? gia du?ng";
                        break;
                    case 7 : $item['cat_title'] = "Thię?t bi? v?n pho?ng";
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

function get_list_media($type = "") {
    if (!empty($type)) {
        $result = db_fetch_array("SELECT * FROM `tbl_media` WHERE `type` = '{$type}'");
        if (!empty($result))
            return $result;
    }
    return false;
}