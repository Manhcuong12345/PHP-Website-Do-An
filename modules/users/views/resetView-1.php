<!DOCTYPE html>
<html>

    <head>
        <title>Unitop Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
            <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/> -->
        <link href="public/reset.css" rel="stylesheet" type="text/css" />
        <!-- <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/> -->
        <link href="public/style.css" rel="stylesheet" type="text/css" />
        <link href="public/responsive.css" rel="stylesheet" type="text/css" />

        <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="public/js/main.js" type="text/javascript"></script>
        <script src="public/js/jquery-3.4.1.min.js"></script>
        <script src="public/js/app.js"></script>
    </head>

    <body>
        <div id="wp_reset">
            <div id="wp_form_reset">
                <h1 class="page_title">Khôi phục mật khẩu</h1>
                <form id="form_reset" action="" method="post">
                    <input type="text" name="email" id="email" placeholder="Nhập email">
                    <p class="error"><?php echo form_error('email'); ?></p>
                    <input type="submit" name="btn_reset" id="btn_reset" value="Gửi yêu cầu">
                </form>
                <a href="?">Trở về trang chủ</a>
            </div>

        </div>

    </body>

</html>