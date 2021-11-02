<?php

function construct() {
    load_model('index');
}

function indexAction() {
    $cat_id = (int) $_GET['cat_id'];
    $data['info_cat'] = get_info_cat($cat_id);
    $data['list_product'] = get_list_product_by_cat_id($cat_id);

    // if (isset($_SESSION['cart']['info'])) {
    //     $data['num_oder'] = $_SESSION['cart']['info']['num_oder'];
    // } else {
    //     $data['num_oder'] = 0;
    // }
    load_view('index', $data);
}

function detailAction() {
    load('helper', 'string');
    load('helper', 'format');
    $product_id = (int) $_GET['id'];
    $slug = $_GET['name'];

    $data['list_cat'] = get_list_cat();
    $product = get_product("", $slug);
    $product_code = $product['code'];
    $cat_id = $product['cat_id'];

    $data['slider_thumbnail'] = get_slider_thumbnail_by_product_code($product_code);

    $data['product'] = $product;
    $data['same_category_product'] = get_list_same_category_product($cat_id, $product_id);

    $data['list_media_slider'] = get_list_media('slider');
    $data['list_media_banner'] = get_list_media('image');

    load_view('detail', $data);
}

function showListProductAction() {

    load('helper', 'format');
    load('lib', 'pagging');
    $cat_id = (int) $_GET['cat_id'];

    # Control List Product
    $num_per_page = 8;
    $data['num_rows'] = get_num_rows("tbl_product", "`cat_id` = {$cat_id} AND `status` = '1'");

    $data['num_page'] = ceil($data['num_rows'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
    $data['cat_id'] = $cat_id;
    $start = ($data['page'] - 1) * $num_per_page;

    $data['list_product'] = get_list_product($cat_id, $start, $num_per_page);

    $data['total_num_rows'] = $data['num_rows'];
    $data['num_show'] = count($data['list_product']);

    # Filer
    if (isset($_POST['btn-submit'])) {
        if (!empty($_POST['r-price'])) {
            $r_price = $_POST['r-price'];

            $data['num_page'] = 0;
            $data['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
            // $start =  ($data['page'] - 1) * $num_per_page;
            $data['list_product'] = get_list_product_by_filter($cat_id, $r_price);

            if (!empty($data['list_product'])) {
                $data['num_show'] = count($data['list_product']);
                $data['total_num_rows'] = count($data['list_product']);
            }
        }
        if (!empty($_POST['select'])) {
            $sort_by = $_POST['select'];

            $data['num_page'] = 0;
            $data['page'] = isset($_GET['page']) ? $_GET['page'] : 1;


            $data['list_product'] = get_list_product_by_sort($cat_id, $sort_by);
            if (!empty($data['list_product'])) {
                $data['num_show'] = count($data['list_product']);
                $data['total_num_rows'] = count($data['list_product']);
            }
        }
    }

    # Control Product Category

    $data['list_cat'] = get_list_cat();
    $data['category'] = get_info_cat($cat_id);

    $data['list_media_slider'] = get_list_media('slider');
    $data['list_media_banner'] = get_list_media('image');

    load_view('showListProduct', $data);
}