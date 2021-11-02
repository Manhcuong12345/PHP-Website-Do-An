<?php

function construct() {
    load_model('index');
    load('lib', 'validation');
}

function indexAction() {
    load('lib', 'email');

    global $error, $username, $password, $email, $fullname;

    if (isset($_POST['btn_reg'])) {

        $error = array();

        #Check fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống fullname";
        } else {
            $fullname = $_POST['fullname'];
        }

        # Check username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống username";
        } else {
            if (!(strlen($_POST['username']) >= 6 && strlen($_POST['username']) <= 32)) {
                $error['username'] = "Số lượng yêu cầu từ 6 đến 32 ký tự";
            } else {
                $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
                if (!is_username($_POST['username'])) {
                    $error['username'] = "Username không đúng định dạng";
                } else {
                    if (is_exists("tbl_user", "username", $_POST['username'])) {
                        $error['username'] = "Tên đăng nhập đã tồn tại";
                    } else {
                        $username = $_POST['username'];
                    }
                }
            }
        }

        # Check password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống password";
        } else {
            if (!(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 32)) {
                $error['password'] = "Số lượng yêu cầu từ 6 đến 32 ký tự";
            } else {
                $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
                if (!is_password($_POST['password'])) {
                    $error['password'] = "Mật khẩu không đúng định dạng";
                } else {
                    $password = md5($_POST['password']);
                }
            }
        }

        #Check email 
        if (empty($_POST['email'])) {
            $error['email'] = 'Không được để trống';
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email không đúng định dạng";
            } else {
                if (is_exists("tbl_user", "email", $_POST['email'])) {
                    $error['email'] = "Email đã tồn tại";
                } else {
                    $email = $_POST['email'];
                }
            }
        }

        #Check telephone
        if (!empty($_POST['tel'])) {
            if (!is_phone_number($_POST['tel'])) {
                $error['tel'] = "Số điện thoại không đúng định dạng";
            } else {
                $tel = $_POST['tel'];
            }
        }

        #Check address
        if (!empty($_POST['address'])) {
            $address = $_POST['address'];
        }

        #Check Gender
        if (empty($_POST['gender'])) {
            $error['gender'] = "Phải chọn giới tính";
        } else {
            $gender = $_POST['gender'];
        }

        if (empty($error)) {
            if (!user_exists($username, $email)) {
                $active_token = md5($username . time());
                $subject = 'Kích hoạt tài khoản';
                $registry_date = time();
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'tel' => $tel,
                    'address' => $address,
                    'registry_date' => $registry_date,
                    'active_token' => $active_token,
                );
                add_user($data);
                $link_active = base_url("?mod=users&controller=index&action=active&active_token=$active_token");
                $content = "<p>Chào bạn {$fullname}, bạn vui lòng click vào {$link_active} này để kích hoạt tài khoản </p>
                <p>Nếu không phải bạn đăng ký vui lòng bỏ qua email này</p>
                <p>Nhóm hỗ trợ .....</p>";

                send_mail($email, $fullname, $subject, $content);

                redirect("?mod=users&action=checkMail");
            } else {
                $error['account'] = "Username hoặc email đã tồn tại ";
            }
        }
    }
    load_view('index');
}

function checkMailAction() {
    load_view('checkMail');
}

function activeAction() {
    $active_token = $_GET['active_token'];
    $link_login = base_url("?mod=users&action=login");

    if (check_token($active_token)) {
        if (active_user($active_token)) {
            echo "Kích hoạt thành công vui lòng click vào <a href='{$link_login}'>đây</a> để đăng nhập";
        } else {
            echo "Bạn đã kích hoạt trước đó";
        }
    } else {
        echo "Mã kích hoạt không hợp lệ";
    }
}

function loginAction() {

    global $error, $username, $password;
    if (isset($_POST['btn_login'])) {
        $error = array();

        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống username";
        } else {
            if (!(strlen($_POST['username']) >= 6 && strlen($_POST['username']) <= 32)) {
                $error['username'] = "Số lượng yêu cầu từ 6 đến 32 ký tự";
            } else {
                if (!is_username($_POST['username'])) {
                    $error['username'] = "Username không đúng định dạng";
                } else {
                    $username = $_POST['username'];
                }
            }
        }

        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống password";
        } else {
            if (!(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 32)) {
                $error['password'] = "Số lượng yêu cầu từ 6 đến 32 ký tự";
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = "Mật khẩu không đúng định dạng";
                } else {
                    $password = $_POST['password'];
                }
            }
        }

        # login processing
        if (empty($error)) {
            if (check_login($username, $password)) {
                # Set cookie
                if (isset($_POST['remember_me'])) {
                    setcookie('is_login', true, time() + 900);
                    setcookie('user_login', $username, time() + 900);
                }
                # Set session
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;

                redirect("home.html");
            } else {
                $error['account'] = "Tên đăng nhập hoặc mật khẩu không đúng";
            }
        }
    }
    load_view('login');
}

function logoutAction() {
    setcookie('is_login', true, time() - 900);
    setcookie('user_login', $username, time() - 900);
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect('home.html');
}

function resetPassAction() {
    load('lib', 'email');
    global $error;
    $reset_token = $_GET['reset_token'];

    if (!empty($reset_token)) {
        if (check_reset_token($reset_token)) {
            if (isset($_POST['btn_reg'])) {
                $error = array();

                if (empty($_POST['password'])) {
                    $error['password'] = "Không được để trống password";
                } else {
                    if (!(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 32)) {
                        $error['password'] = "Số lượng yêu cầu từ 6 đến 32 ký tự";
                    } else {
                        $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
                        if (!is_password($_POST['password'])) {
                            $error['password'] = "Mật khẩu không đúng định dạng";
                        } else {
                            $password = md5($_POST['password']);
                        }
                    }
                }

                if (empty($error)) {
                    $reset_date = time();
                    $data = array(
                        'password' => $password,
                        'reset_date' => $reset_date,
                        'reset_token' => "",
                    );
                    update_pass($data, $reset_token);
                    redirect("?mod=users&action=resetOk");
                }
            }
            load_view('newPass');
        } else {
            echo "Yêu cầu lấy lại pass ko hợp lệ";
        }
    } else {
        if (isset($_POST['btn_reset'])) {
            $error = array();

            if (empty($_POST['email'])) {
                $error['email'] = "Không được để trống email";
            } else {
                if (!is_email($_POST['email'])) {
                    $error['email'] = "Email không đúng định dạng";
                } else {
                    $email = $_POST['email'];
                }
            }

            if (empty($error)) {
                if (check_email($email)) {
                    $reset_token = md5($email . time());
                    $data = array(
                        'reset_token' => $reset_token
                    );
                    update_reset_token($data, $email);
                    $link = base_url("?mod=users&controller=index&action=resetPass&reset_token={$reset_token}");
                    $content = "<p>Bạn vui lòng lick vào <a href='{$link}'>đây</a> để thiết lập lại mật khẩu. Nếu không phải bạn thì vui lòng bỏ qua email này </p>";

                    send_mail($email, '', 'Khôi phục mật khẩu PHP master', $content);
                } else {
                    $error['email'] = "Email không tồn tại trên hệ thống";
                }
            }
        }
        load_view('reset');
    }
}

function resetOkAction() {
    load_view('resetOk');
}

function detailAction() {

    global $error;

    $user_login = $_SESSION['user_login'];
    $data['user_info'] = get_user_info($user_login);

    if ($data['user_info']['gender'] == "male") {
        $data['gender'] = "Nam";
    } elseif ($data['user_info']['gender'] == "female") {
        $data['gender'] = "Nữ";
    }

    if (isset($_POST['btn_update_info'])) {
        $error = array();

        if (empty($_POST['fullname'])) {
            $fullname = $data['user_info']['fullname'];
        } else {
            $fullname = $_POST['fullname'];
        }

        if (empty($_POST['tel'])) {
            $tel = $data['user_info']['tel'];
        } else {
            if (!is_phone_number($_POST['tel'])) {
                $error['tel'] = "Số điện thoại không đúng định dạng";
            } else {
                $tel = $_POST['tel'];
            }
        }

        if (empty($_POST['address'])) {
            $address = $data['user_info']['address'];
        } else {
            $address = $_POST['address'];
        }

        if (empty($_POST['gender'])) {
            $gender = $data['user_info']['gender'];
        } else {
            $gender = $_POST['gender'];
            echo $gender;
        }

        if (empty($error)) {
            $data = array(
                'fullname' => $fullname,
                'tel' => $tel,
                'address' => $address,
                'gender' => $gender
            );
            update_user_info($data, $user_login);
            redirect("?mod=users&action=detail");
        }
    }

    if (isset($_POST['btn_update_pass'])) {
        $error = array();

        if (!empty($_POST['password'])) {
            if (!(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 32)) {
                $error['password'] = "Số lượng yêu cầu từ 6 đến 32 ký tự";
            } else {
                $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
                if (!is_password($_POST['password'])) {
                    $error['password'] = "Mật khẩu không đúng định dạng";
                } else {
                    $password = md5($_POST['password']);
                }
            }
        }

        if (empty($error)) {
            $data = array(
                'password' => $password,
            );
            update_user_info($data, $user_login);
            redirect("?mod=users&action=login");
        }
    }

    load_view('detail', $data);
}

//----------------------------------------------------
function deleteAction() {
    $user_id = $_GET['id'];
    db_delete('tbl_user', "`user_id` = {$user_id}");
    redirect("?mod=users&controller=index");
}

function updateAction() {
    global $error, $fullname, $username, $password, $email, $income, $gender;
    $user_id = $_GET['id'];

    if (isset($_POST['btn_update'])) {
        $error = array();

        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống Họ và tên";
        } else {
            $fullname = $_POST['fullname'];
        }

        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống Tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }

        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống Mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }

        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }

        if (empty($_POST['income'])) {
            $error['income'] = "Không được để trống thu nhập";
        } else {
            $income = $_POST['income'];
        }

        if (empty($_POST['gender'])) {
            $error['gender'] = "Phải chọn giới tính";
        } else {
            $gender = $_POST['gender'];
        }

        if (empty($error)) {
            $data = array(
                'fullname' => $fullname,
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'income' => $income,
                'gender' => $gender,
            );
            db_update('tbl_user', $data, "`user_id` = {$user_id}");
        }
    }

    load_view('update');
}
