<?php

function construct() {
    load_model('index');
    load('helper', 'format');
    load('helper', 'cart');
}

function indexAction() {
    if (isset($_SESSION['cart']['buy'])) {
        foreach ($_SESSION['cart']['buy'] as &$item) {
            $item['url_delete_cart'] = "?mod=cart&action=delete&id={$item['id']}";
            $item['url_detail'] = "?mod=products&action=detail&id={$item['id']}";
        }
        $data['list_buy'] = $_SESSION['cart']['buy'];
        $data['total_cart'] = $_SESSION['cart']['info']['total'];

        if (isset($_SESSION['cart']['info'])) {
            $data['num_order'] = $_SESSION['cart']['info']['num_order'];
        }

        load_view('index', $data);
    } else {
        if (isset($_SESSION['cart']['info'])) {
            $data['num_order'] = $_SESSION['cart']['info']['num_order'];
        } else {
            $data['num_order'] = 0;
        }
        load_view('index', $data);
    }
}

function addCartAction() {

    $id = (int) $_GET['id'];
    $item = get_product_by_id($id);

    if (isset($_GET['num-order'])) {
        $quantity = $_GET['num-order'];
        if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            $quantity = $_SESSION['cart']['buy'][$id]['quantity'] + $quantity;
        }
        if ($quantity > 15)
            $quantity = 15;
    }else {
        $quantity = 1;
        if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            $quantity = $_SESSION['cart']['buy'][$id]['quantity'] + 1;
        }
    }

    $_SESSION['cart']['buy'][$id] = array(
        'id' => $item['id'],
        'title' => $item['title'],
        'price' => $item['price'],
        'code' => $item['code'],
        'url' => $item['url'],
        'thumbnail' => $item['thumbnail'],
        'quantity' => $quantity,
        'sub_total' => $item['price'] * $quantity,
    );
    update_info_cart();
    redirect("cart.html");
}

function deleteAction() {
    $id = (int) $_GET['id'];
    if (empty($id)) {
        unset($_SESSION['cart']['buy']);
        update_info_cart();
        redirect("cart.html");
    } else {
        unset($_SESSION['cart']['buy'][$id]);
        update_info_cart();
        redirect("cart.html");
    }
}

function checkoutAction() {
    load('lib', 'validation');

    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
    }
    global $error, $fullname, $email, $address, $tel, $payment_method, $note;

    if ($_SESSION['is_login']) {
        if (empty($id)) {
            if (isset($_POST['checkout'])) {

                $error = array();

                if (empty($_POST['fullname'])) {
                    $error['fullname'] = "Kh??ng ???????c ????? tr???ng H??? v?? T??n";
                } else {
                    $fullname = $_POST['fullname'];
                }

                if (empty($_POST['email'])) {
                    $error['email'] = "Kh??ng ???????c ????? tr???ng email";
                } else {
                    $email = $_POST['email'];
                }

                if (empty($_POST['address'])) {
                    $error['address'] = "Kh??ng ???????c ????? tr???ng ?????a ch???";
                } else {
                    $address = $_POST['address'];
                }

                if (empty($_POST['tel'])) {
                    $error['tel'] = "Kh??ng ???????c ????? tr???ng s??? ??i???n tho???i";
                } else {
                    if (!is_phone_number($_POST['tel'])) {
                        $error['tel'] = "S??? ??i???n tho???i kh??ng ????ng ?????nh d???ng";
                    } else {
                        $tel = $_POST['tel'];
                    }
                }

                if (empty($_POST['payment-method'])) {
                    $error['payment-method'] = "Ph???i ch???n ph????ng th???c thanh to??n";
                } else {
                    $payment_method = $_POST['payment-method'];
                }

                $note = $_POST['note'];

                if (empty($error)) {
                    $_SESSION['cart']['customer_info'] = array(
                        'name' => $fullname,
                        'email' => $email,
                        'address' => $address,
                        'telephone_number' => $tel,
                        'note' => $note,
                        'payment_method' => $payment_method,
                    );
                    // show_array($_SESSION['cart']);
                    receiveOderAction();
                }
            }

            if (isset($_SESSION['cart']['buy'])) {
                $data['list_buy'] = $_SESSION['cart']['buy'];
                $data['num_order'] = $_SESSION['cart']['info']['num_order'];
                $data['total'] = $_SESSION['cart']['info']['total'];
                load_view('checkout', $data);
            }
        } else {

            $item = get_product_by_id($id);

            $quantity = 1;
            if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
                $quantity = $_SESSION['cart']['buy'][$id]['quantity'] + 1;
            }

            $_SESSION['cart']['buy'][$id] = array(
                'id' => $item['id'],
                'title' => $item['title'],
                'price' => $item['price'],
                'code' => $item['code'],
                'url' => "",
                'thumbnail' => $item['thumbnail'],
                'quantity' => $quantity,
                'sub_total' => $item['price'] * $quantity,
            );
            update_info_cart();

            if (isset($_POST['checkout'])) {

                $error = array();

                if (empty($_POST['fullname'])) {
                    $error['fullname'] = "Kh??ng ???????c ????? tr???ng H??? v?? T??n";
                } else {
                    $fullname = $_POST['fullname'];
                }

                if (empty($_POST['email'])) {
                    $error['email'] = "Kh??ng ???????c ????? tr???ng email";
                } else {
                    $email = $_POST['email'];
                }

                if (empty($_POST['address'])) {
                    $error['address'] = "Kh??ng ???????c ????? tr???ng ?????a ch???";
                } else {
                    $address = $_POST['address'];
                }

                if (empty($_POST['tel'])) {
                    $error['tel'] = "Kh??ng ???????c ????? tr???ng s??? ??i???n tho???i";
                } else {
                    if (!is_phone_number($_POST['tel'])) {
                        $error['tel'] = "S??? ??i???n tho???i kh??ng ????ng ?????nh d???ng";
                    } else {
                        $tel = $_POST['tel'];
                    }
                }

                if (empty($_POST['payment-method'])) {
                    $error['payment-method'] = "Ph???i ch???n ph????ng th???c thanh to??n";
                } else {
                    $payment_method = $_POST['payment-method'];
                }

                $note = $_POST['note'];

                if (empty($error)) {
                    $_SESSION['cart']['customer_info'] = array(
                        'name' => $fullname,
                        'email' => $email,
                        'address' => $address,
                        'telephone_number' => $tel,
                        'note' => $note,
                        'payment_method' => $payment_method,
                    );
                    // show_array($_SESSION['cart']);
                    receiveOderAction();
                }
            }

            if (isset($_SESSION['cart']['buy'])) {
                $data['list_buy'] = $_SESSION['cart']['buy'];
                $data['num_order'] = $_SESSION['cart']['info']['num_order'];
                $data['total'] = $_SESSION['cart']['info']['total'];
                load_view('checkout', $data);
            }
        }
    } else {
        redirect("login.html");
    }
}

function receiveOderAction() {
    load('helper', 'email');
    load('lib', 'email');

    if (isset($_SESSION['cart'])) {
        # L???y th??ng tin, x???p s???p th??ng tin h???p ?????ng
        // 1. Th??ng tin gi??? h??ng
        $num_order = $_SESSION['cart']['info']['num_order'];
        $total = $_SESSION['cart']['info']['total'];

        // 2. Th??ng tin kh??ch h??ng
        $customer_fullname = $_SESSION['cart']['customer_info']['name'];
        $customer_email = $_SESSION['cart']['customer_info']['email'];
        $customer_address = $_SESSION['cart']['customer_info']['address'];
        $customer_telephone_number = $_SESSION['cart']['customer_info']['telephone_number'];
        $customer_note = $_SESSION['cart']['customer_info']['note'];
        $payment_method = $_SESSION['cart']['customer_info']['payment_method'];
        $username = $_SESSION['user_login'];
        $user_id = get_user_id($username);

        // 3. Th??ng tin h???p ?????ng
        $transaction_code = rand();
        $subject = "[Unitop store] Shopping - X??c nh???n ????n h??ng {$transaction_code}";
        $form_email_cart = form_email_cart();
        $content = "C???m ??n kh??ch h??ng {$customer_fullname} ???? ?????t h??ng t??? c???a h??ng ch??ng t??i. ????y l?? Email th??ng b??o quy tr??nh ?????t h??ng ???? ho??n t???t. D?????i ????y l?? c??c m???t h??ng qu?? kh??ch ???? ?????t mua: </br></br>" . $form_email_cart;
        $created_date = time();

        # L??u th??ng tin h???p ?????ng v??o database
        $data = array(
            'transaction_code' => $transaction_code,
            'username' => $username,
            'user_id' => $user_id,
            'fullname' => $customer_fullname,
            'email' => $customer_email,
            'phone' => $customer_telephone_number,
            'address' => $customer_address,
            'payment_method' => $payment_method,
            'note' => $customer_note,
            'created_date' => $created_date,
            'quantity' => $num_order,
            'total' => $total,
        );

        add_transaction($data);

        # L??u th??ng tin ????n h??ng
        foreach ($_SESSION['cart']['buy'] as $item) {
            $data = array(
                'transaction_code' => $transaction_code,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'sub_total' => $item['sub_total'],
            );
            add_order($data);
        }

        #L??u th??ng tin kh??ch h??ng
        # G???i mail x??c nh???n ????n h??ng cho kh??ch
        send_mail($customer_email, $customer_fullname, $subject, $content);

        # G???i mail b??o c??o th??ng tin ????n h??ng 
        $my_email = "thanhlan9962@gmail.com";
        $content = "Nh???n ????n h??ng {$transaction_code} t??? kh??ch h??ng {$customer_fullname} g???m" . $form_email_cart . "<p>?????a ch???: <strong>{$customer_address}</strong></p><p>S??? ??i???n tho???i c???a kh??ch h??ng: <strong>{$customer_telephone_number}</strong></p><p>Ch?? th??ch: <strong>{$customer_note}</strong></p><p>Ph????ng th???c thanh to??n: <strong>{$payment_method}</strong></p>";
        send_mail($my_email, "", $subject, $content);
        unset($_SESSION['cart']);
        update_info_cart();

        load_view('thanks');
    }
}

function updateAction() {

    if (isset($_POST['update_cart'])) {
        $error = array();

        $id = (int) $_POST['id'];
        $num_order = (int) $_POST['num_order'];
        if ($num_order > 15) {
            $selector_num_order = "tr[data-id='{$id}'] > td:nth-child(5) > p";
            $result = array(
                'num_order' => "S??? l?????ng order qu?? l???n",
                'selector_num_order' => $selector_num_order,
            );
            echo json_encode($result);
        } else {
            $price = $_SESSION['cart']['buy'][$id]['price'];
            $sub_total = $price * $num_order;

            $selector_sub_total = "tr[data-id='{$id}'] > td:nth-child(6)";
            $selector_num_order = "tr[data-id='{$id}'] > td:nth-child(5) > p";

            $_SESSION['cart']['buy'][$id]['quantity'] = $num_order;
            $_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total;
            update_info_cart();

            $cart_num_order = $_SESSION['cart']['info']['num_order'];
            $total = $_SESSION['cart']['info']['total'];

            $text = "{$cart_num_order} s???n ph???m";

            $result = array(
                'id' => $id,
                'num_order' => $num_order,
                'price' => $price,
                'sub_total' => number_format($sub_total) . "??",
                'selector_sub_total' => $selector_sub_total,
                'cart_num_order' => $cart_num_order,
                'total' => number_format($total) . "??",
                'num_order' => "",
                'selector_num_order' => $selector_num_order,
                'text' => $text,
            );
            echo json_encode($result);
        }
    } elseif (isset($_POST['show_dropdown_cart'])) {
        $num_order = $_SESSION['cart']['info']['num_order'];

        $result = array(
            'num_order' => "{$num_order} s???n ph???m",
        );
        echo json_encode($result);
    }
}

function addCartAjaxAction() {
    if (isset($_POST['add_cart_ajax'])) {
        $id = (int) $_POST['id'];
        $item = get_product_by_id($id);
        // $id = $item['id'];
        // $price = $_SESSION['cart']['buy'][$id]['price'];
        // $sub_total = $price * $num_order;
        // $quantity = (int) $_POST['num_order'];
        // if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        //     $quantity = $_SESSION['cart']['buy'][$id]['quantity'] + 1;
        // }
        // $_SESSION['cart']['buy'][$id] = array(
        //     'id' => $item['id'],
        //     'title' => $item['title'],
        //     'price' => $item['price'],
        //     'code' => $item['code'],
        //     'url' => $item['url'],
        //     'thumbnail' => $item['thumbnail'],
        //     'quantity' => $quantity,
        //     'sub_total' => $item['price'] * $quantity,
        // );
        // update_info_cart();
        $result = array(
            'id' => $id,
            'item' => $item,
        );
        echo json_encode($result);
    }
}

function buyNowAction() {

    $id = (int) $_GET['id'];
    $item = get_product_by_id($id);

    if (isset($_GET['num-order'])) {
        $quantity = $_GET['num-order'];
        if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            $quantity = $_SESSION['cart']['buy'][$id]['quantity'] + $quantity;
        }
        if ($quantity > 15)
            $quantity = 15;
    }else {
        $quantity = 1;
        if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            $quantity = $_SESSION['cart']['buy'][$id]['quantity'] + 1;
        }
    }

    $_SESSION['cart']['buy'][$id] = array(
        'id' => $item['id'],
        'title' => $item['title'],
        'price' => $item['price'],
        'code' => $item['code'],
        'url' => $item['url'],
        'thumbnail' => $item['thumbnail'],
        'quantity' => $quantity,
        'sub_total' => $item['price'] * $quantity,
    );
    update_info_cart();
    redirect("checkout.html");
}
