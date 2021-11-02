<?php

function construct() {
    load_model('index');
}

function indexAction() {
    load('helper', 'format');
    load('lib', 'pagging');

    # Numrows
    $num_per_page = 4;
    $num_rows_mobile = get_num_rows("tbl_product", "`cat_id` = 1 AND `status` = '1' AND `tracking` = '1'");
    $num_rows_tablet = get_num_rows("tbl_product", "`cat_id` = 2 AND `status` = '1' AND `tracking` = '1'");
    $num_rows_laptop = get_num_rows("tbl_product", "`cat_id` = 3 AND `status` = '1' AND `tracking` = '1'");

    # Number of page
    $data['num_page_mobile'] = ceil($num_rows_mobile / $num_per_page);
    $data['num_page_tablet'] = ceil($num_rows_tablet / $num_per_page);
    $data['num_page_laptop'] = ceil($num_rows_laptop / $num_per_page);

    # Get Page and Start
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    # List_product
    // 1. Main Product
    $data['list_mobile'] = get_list_product(1, $start, $num_per_page);
    $data['list_tablet'] = get_list_product(2, $start, $num_per_page);
    $data['list_laptop'] = get_list_product(3, $start, $num_per_page);

    // 2. Top Product
    $data['list_featured_product'] = get_list_featured_product();
    $data['list_best_seller'] = get_list_best_seller();

    # List_media

    $data['list_media_slider'] = get_list_media('slider');
    $data['list_media_banner'] = get_list_media('image');

    load_view('index', $data);
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
    $pagging = render_pagging($num_page, $page, "home.html");

    $result = array(
        'list_product' => $list_product,
        'pagging' => $pagging
    );
    echo json_encode($result);
}
