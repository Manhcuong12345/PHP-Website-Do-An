<?php

function construct() {
    load_model('index');
}

function indexAction() {
    load('helper', 'format');
    load('lib', 'pagging');
    load('helper', 'css');

    if (!empty($_GET['s'])) {
        $s = $_GET['s'];

        $num_per_page = 8;
        $data['num_rows'] = get_num_rows("tbl_product", "`title` LIKE '%{$s}%' AND `status` = '1'");
        $data['num_page'] = ceil($data['num_rows'] / $num_per_page);
        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($data['page'] - 1) * $num_per_page;
        $data['list_search_item'] = search_item("tbl_product", "title", $s, $start, $num_per_page);
        $data['s'] = $s;
        // show_array($data['list_search_item']);  
        # List_media

        $data['list_media_slider'] = get_list_media('slider');
        $data['list_media_banner'] = get_list_media('image');

        load_view('index', $data);
    } else {
        redirect("home.html");
    }
}