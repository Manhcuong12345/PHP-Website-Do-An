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
                    $error['fullname'] = "Không được để trống Họ và Tên";
                } else {
                    $fullname = $_POST['fullname'];
                }

                if (empty($_POST['email'])) {
                    $error['email'] = "Không được để trống email";
                } else {
                    $email = $_POST['email'];
                }

                if (empty($_POST['address'])) {
                    $error['address'] = "Không được để trống địa chỉ";
                } else {
                    $address = $_POST['address'];
                }

                if (empty($_POST['tel'])) {
                    $error['tel'] = "Không được để trống số điện thoại";
                } else {
                    if (!is_phone_number($_POST['tel'])) {
                        $error['tel'] = "Số điện thoại không đúng định dạng";
                    } else {
                        $tel = $_POST['tel'];
                    }
                }

                if (empty($_POST['payment-method'])) {
                    $error['payment-method'] = "Phải chọn phương thức thanh toán";
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
                    $error['fullname'] = "Không được để trống Họ và Tên";
                } else {
                    $fullname = $_POST['fullname'];
                }

                if (empty($_POST['email'])) {
                    $error['email'] = "Không được để trống email";
                } else {
                    $email = $_POST['email'];
                }

                if (empty($_POST['address'])) {
                    $error['address'] = "Không được để trống địa chỉ";
                } else {
                    $address = $_POST['address'];
                }

                if (empty($_POST['tel'])) {
                    $error['tel'] = "Không được để trống số điện thoại";
                } else {
                    if (!is_phone_number($_POST['tel'])) {
                        $error['tel'] = "Số điện thoại không đúng định dạng";
                    } else {
                        $tel = $_POST['tel'];
                    }
                }

                if (empty($_POST['payment-method'])) {
                    $error['payment-method'] = "Phải chọn phương thức thanh toán";
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
        # Lấy thông tin, xắp sếp thông tin hợp đồng
        // 1. Thông tin giỏ hàng
        $num_order = $_SESSION['cart']['info']['num_order'];
        $total = $_SESSION['cart']['info']['total'];

        // 2. Thông tin khách hàng
        $customer_fullname = $_SESSION['cart']['customer_info']['name'];
        $customer_email = $_SESSION['cart']['customer_info']['email'];
        $customer_address = $_SESSION['cart']['customer_info']['address'];
        $customer_telephone_number = $_SESSION['cart']['customer_info']['telephone_number'];
        $customer_note = $_SESSION['cart']['customer_info']['note'];
        $payment_method = $_SESSION['cart']['customer_info']['payment_method'];
        $username = $_SESSION['user_login'];
        $user_id = get_user_id($username);

        // 3. Thông tin hợp đồng
        $transaction_code = rand();
        $subject = "[Unitop store] Shopping - Xác nhận đơn hàng {$transaction_code}";
        $form_email_cart = form_email_cart();
        $content = "Cảm ơn khách hàng {$customer_fullname} đã đặt hàng từ cửa hàng chúng tôi. Đây là Email thông báo quy trình đặt hàng đã hoàn tất. Dưới đây là các mặt hàng quý khách đã đặt mua: </br></br>" . $form_email_cart;
        $created_date = time();

        # Lưu thông tin hợp đồng vào database
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

        # Lưu thông tin đơn hàng
        foreach ($_SESSION['cart']['buy'] as $item) {
            $data = array(
                'transaction_code' => $transaction_code,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'sub_total' => $item['sub_total'],
            );
            add_order($data);
        }

        #Lưu thông tin khách hàng
        # Gửi mail xác nhận đơn hàng cho khách
        send_mail($customer_email, $customer_fullname, $subject, $content);

        # Gửi mail báo cáo thông tin đơn hàng 
        $my_email = "thanhlan9962@gmail.com";
        $content = "Nhận đơn hàng {$transaction_code} từ khách hàng {$customer_fullname} gồm" . $form_email_cart . "<p>Địa chỉ: <strong>{$customer_address}</strong></p><p>Số điện thoại của khách hàng: <strong>{$customer_telephone_number}</strong></p><p>Chú thích: <strong>{$customer_note}</strong></p><p>Phương thức thanh toán: <strong>{$payment_method}</strong></p>";
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
                'num_order' => "Số lượng order quá lớn",
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

            $text = "{$cart_num_order} sản phẩm";

            $result = array(
                'id' => $id,
                'num_order' => $num_order,
                'price' => $price,
                'sub_total' => number_format($sub_total) . "đ",
                'selector_sub_total' => $selector_sub_total,
                'cart_num_order' => $cart_num_order,
                'total' => number_format($total) . "Đ",
                'num_order' => "",
                'selector_num_order' => $selector_num_order,
                'text' => $text,
            );
            echo json_encode($result);
        }
    } elseif (isset($_POST['show_dropdown_cart'])) {
        $num_order = $_SESSION['cart']['info']['num_order'];

        $result = array(
            'num_order' => "{$num_order} sản phẩm",
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
