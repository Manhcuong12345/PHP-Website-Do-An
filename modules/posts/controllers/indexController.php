<?php

function construct() {
    load_model('index');
}

function indexAction() {
    load('helper', 'format');
    load('lib', 'pagging');

    # Numrows
    $num_per_page = 5;
    $num_rows = get_num_rows("tbl_post", "`post_status` = '1'");

    # Number of page
    $data['num_page'] = ceil($num_rows / $num_per_page);

    # Get Page and Start
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    # List Post
    // 1. Main Post
    $data['list_post'] = get_list_post(1, $start, $num_per_page);

    // 2. Top Product
    $data['list_featured_product'] = get_list_featured_product();
    $data['list_best_seller'] = get_list_best_seller();

    # List media
    $data['list_media_banner'] = get_list_media('image');

    load_view('index', $data);
}

function detailAction() {
    load('helper', 'format');
    $id = (int) $_GET['id'];

    $data['post'] = get_post_by_id($id);

    // 2. Top Product
    $data['list_featured_product'] = get_list_featured_product();
    $data['list_best_seller'] = get_list_best_seller();
    # List media
    $data['list_media_banner'] = get_list_media('image');

    load_view('detail', $data);
}

function paggingAction() {

    load('lib', 'pagging');
    load('helper', 'format');

    $page = (int) $_POST['page'];
    $cat_id = (int) $_POST['cat_id'];

    $num_per_page = 4;
    $start = ($page - 1) * $num_per_page;
    $num_rows = get_num_rows("tbl_product", "`cat_id` = {$cat_id} AND `status` = '1' AND `tracking` = '1'");
    $num_page = ceil($num_rows / $num_per_page);

    $list_product = render_list_product(get_list_product($cat_id, $start, $num_per_page));
    $pagging = render_pagging($num_page, $page, "?mod=home&action=index");

    $result = array(
        'list_product' => $list_product,
        'pagging' => $pagging
    );
    echo json_encode($result);
}