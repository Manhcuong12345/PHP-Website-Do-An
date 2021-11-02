<?php

function construct() {
    load_model('index');
}

function detailAction() {
    load('helper', 'string');
    load('helper', 'format');
    $id = (int) $_GET['id'];

    $data['page'] = get_page($id);

    $data['list_featured_product'] = get_list_featured_product();
    $data['list_best_seller'] = get_list_best_seller();

    $data['list_media_slider'] = get_list_media('slider');
    $data['list_media_banner'] = get_list_media('image');

    load_view('detail', $data);
}